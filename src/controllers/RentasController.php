<?php
require_once 'src/models/Renta.php';
require_once 'src/models/Search.php';
require_once 'utils/slugify.php';

class RentasController
{
    private Renta $rentaModel;
    private Search $searchModel;

    public function __construct()
    {
        $this->rentaModel  = new Renta();
        $this->searchModel = new Search();
    }

    private function mergeSeoDefaults(array $customSeo = []): array
    {
        $defaults = [
            'title'       => 'Casas particulares en Cuba | CuVaRents',
            'description' => 'Encuentra casas particulares y apartamentos en alquiler en toda Cuba. Compara opciones y reserva por WhatsApp con CuVaRents.',
            'keywords'    => 'casas particulares en cuba, alquiler casas cuba, rentas cuba, alojamiento cuba, cuvarents',
            'url'         => BASE_URL,
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_CU',
            'robots'      => 'index, follow',
            'breadcrumb'  => [['Inicio', BASE_URL]],
            'pageType'    => 'general'
        ];

        $merged = array_merge($defaults, $customSeo);
        foreach ($merged as $key => $value) {
            if (!is_array($value)) {
                $merged[$key] = $value ?? '';
            }
        }
        return $merged;
    }

    /**
     * Resolver slug -> nombre real (para preservar acentos: Viñales)
     */
    private function resolveProvinciaName(string $slug, array $provincias): string
    {
        foreach ($provincias as $p) {
            $name = trim((string)$p);
            if ($name !== '' && slugify($name) === $slug) {
                return $name;
            }
        }
        return ucwords(str_replace('-', ' ', $slug));
    }

    private function resolveMunicipioName(string $slug, array $zonasPairs): string
    {
        foreach ($zonasPairs as $row) {
            $m = trim((string)($row['municipio'] ?? ''));
            if ($m !== '' && slugify($m) === $slug) {
                return $m;
            }
        }
        return ucwords(str_replace('-', ' ', $slug));
    }

    public function index(): void
    {
        // --- PAGINACIÓN ---
        $page         = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;

        // Robots para paginadas
        $isPaginated    = ($page > 1);
        $robotsForLists = $isPaginated ? 'noindex, follow' : 'index, follow';

        $itemsPerPage = 12;
        $offset       = ($page - 1) * $itemsPerPage;

        $homeSearch = trim($_GET['search'] ?? '');

        // --- CONTEXTO ---
        $categoriaSlug  = $_GET['categoria'] ?? '';
        $provinciaSlug  = $_GET['provincia_slug'] ?? '';
        $municipioSlug  = $_GET['municipio_slug'] ?? '';

        $categoriaNombre = '';
        $provinciaNombre = '';
        $municipioNombre = '';

        if ($categoriaSlug !== '') {
            $categoriaNombre = ucwords(str_replace('-', ' ', $categoriaSlug));
        }

        // --- DATA PARA UI + RESOLUCIÓN DE SLUGS ---
        $zonas      = $this->searchModel->obtenerZonasConProvincia(); // [{provincia, municipio}]
        $provincias = $this->searchModel->obtenerProvincias();        // [string]

        // -------- FILTROS (Search::buscarPropiedades) --------
        $filters = [
            'municipios'   => $_GET['municipio'] ?? [],
            'provincia'    => $_GET['provincia'] ?? '',
            'precios'      => $_GET['precio'] ?? [],
            'habitaciones' => !empty($_GET['habitaciones']) ? (int)$_GET['habitaciones'] : null,
            'capacidad'    => !empty($_GET['capacidad']) ? (int)$_GET['capacidad'] : null,
            'servicios'    => $_GET['servicios'] ?? []
        ];

        if (!is_array($filters['municipios'])) {
            $filters['municipios'] = [$filters['municipios']];
        }

        // --- Forzar filtro por URL (PROVINCIA o MUNICIPIO) ---
        if ($provinciaSlug !== '') {
            $provinciaNombre       = $this->resolveProvinciaName($provinciaSlug, $provincias);
            $filters['provincia']  = $provinciaNombre;
            $filters['municipios'] = [];
        } elseif ($municipioSlug !== '') {
            $municipioNombre       = $this->resolveMunicipioName($municipioSlug, $zonas);
            $filters['municipios'] = [$municipioNombre];
            $filters['provincia']  = '';
        }

        // --- Hay filtros? ---
        $hasFilters =
            (!empty($filters['municipios'])) ||
            (!empty($filters['provincia'])) ||
            (!empty($filters['precios'])) ||
            ($filters['habitaciones'] !== null) ||
            ($filters['capacidad'] !== null) ||
            (!empty($filters['servicios']));

        // -------- CONSULTA PRINCIPAL --------
        if ($hasFilters) {
            $rentsData = $this->searchModel->buscarPropiedades($filters, $itemsPerPage, $offset);
        } elseif ($homeSearch !== '') {
            $rentsData = $this->rentaModel->getRentas($itemsPerPage, $offset, '', '', $homeSearch);
        } elseif ($categoriaNombre !== '') {
            $rentsData = $this->rentaModel->getRentas($itemsPerPage, $offset, $categoriaNombre);
        } else {
            $rentsData = $this->rentaModel->getRentas($itemsPerPage, $offset, '');
        }

        $rents      = $rentsData['rentas'] ?? [];
        $totalPages = $rentsData['totalPages'] ?? 1;

        // Si tu view lo usa, aquí puedes calcularlo real con el COUNT.
        // Como tu Search devuelve totalPages pero no total, lo dejamos null para no mentir.
        $totalResults = null;

        // ----------------------------
        // ZONAS SEO (config dinámica)
        // ----------------------------
        $zonaSeo = [];
        $zonaKey = '';
        if ($categoriaSlug !== '') {
            $catsSeoConfig = require __DIR__ . '/../../config/categorias-seo.php';
            $zonaKey = $categoriaSlug;
            $zonaSeo = $catsSeoConfig[$zonaKey] ?? [];
        } elseif ($provinciaSlug !== '' || $municipioSlug !== '') {
            $zonasSeoConfig = require __DIR__ . '/../../config/zonas-seo.php';
            $zonaKey = ($provinciaSlug !== '') ? $provinciaSlug : $municipioSlug;
            $zonaSeo = $zonasSeoConfig[$zonaKey] ?? [];
        }

        // -------- SEO --------
        if ($categoriaNombre !== '') {

            // 1) Cargar SEO de categorías
            $categoriasSeoConfig = require __DIR__ . '/../../config/categorias-seo.php';
            $categoriaSeo = $categoriasSeoConfig[$categoriaSlug] ?? [];

            $zonaSeo = $categoriaSeo;

            // 3) SEO meta: usa el config si existe, si no cae a default
            $seo = $this->mergeSeoDefaults([
                'title'       => !empty($categoriaSeo['title'])
                    ? $categoriaSeo['title']
                    : "$categoriaNombre en Cuba | CuVaRents",

                'description' => !empty($categoriaSeo['description'])
                    ? $categoriaSeo['description']
                    : "Descubre $categoriaNombre en Cuba. Compara opciones por destino, capacidad y servicios y reserva por WhatsApp con CuVaRents.",

                'url'         => BASE_URL . "rents/$categoriaSlug",
                'robots'      => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Alojamientos', rtrim(BASE_URL, '/') . '/rents'],
                    [$categoriaNombre, rtrim(BASE_URL, '/') . "/rents/$categoriaSlug"]
                ],
                'pageType' => 'rentas-categoria'
            ]);
        } elseif ($provinciaSlug !== '') {

            // Defaults orientados a keyword
            $defaultTitle = "Casas particulares en $provinciaNombre | CuVaRents";
            $defaultDesc  = "Encuentra casas particulares en $provinciaNombre (Cuba). Compara alojamientos por municipios, capacidad y servicios, y reserva por WhatsApp con CuVaRents.";

            // Override si existe en zonas-seo.php
            $title = !empty($zonaSeo['title']) ? $zonaSeo['title'] : $defaultTitle;
            $desc  = !empty($zonaSeo['description']) ? $zonaSeo['description'] : $defaultDesc;

            $seo = $this->mergeSeoDefaults([
                'title'       => $title,
                'description' => $desc,
                'url'         => BASE_URL . "rents/provincias/$provinciaSlug",
                'robots'      => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Alojamientos', rtrim(BASE_URL, '/') . '/rents'],
                    ['Provincias', rtrim(BASE_URL, '/') . '/rents/provincias'],
                    [$provinciaNombre, rtrim(BASE_URL, '/') . "/rents/provincias/$provinciaSlug"]
                ],
                'pageType' => 'rentas-provincia'
            ]);
        } elseif ($municipioSlug !== '') {

            // Defaults orientados a keyword
            $defaultTitle = "Casas particulares en $municipioNombre | CuVaRents";
            $defaultDesc  = "Encuentra casas particulares en $municipioNombre (Cuba). Compara alojamientos por ubicación, capacidad y servicios, y reserva por WhatsApp con CuVaRents.";

            // Override si existe en zonas-seo.php
            $title = !empty($zonaSeo['title']) ? $zonaSeo['title'] : $defaultTitle;
            $desc  = !empty($zonaSeo['description']) ? $zonaSeo['description'] : $defaultDesc;

            $seo = $this->mergeSeoDefaults([
                'title'       => $title,
                'description' => $desc,
                'url'         => BASE_URL . "rents/municipios/$municipioSlug",
                'robots'      => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Alojamientos', rtrim(BASE_URL, '/') . '/rents'],
                    ['Municipios', rtrim(BASE_URL, '/') . '/rents/municipios'],
                    [$municipioNombre, rtrim(BASE_URL, '/') . "/rents/municipios/$municipioSlug"]
                ],
                'pageType' => 'rentas-municipio'
            ]);
        } elseif ($hasFilters || $homeSearch !== '') {

            // Búsquedas y filtros: noindex
            $seo = $this->mergeSeoDefaults([
                'title'       => 'Resultados de búsqueda | CuVaRents',
                'description' => 'Filtra alojamientos en Cuba por destino, precio, capacidad y servicios. Encuentra opciones según tus preferencias.',
                'url'         => BASE_URL . 'rents',
                'robots'      => 'noindex, follow',
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Alojamientos', rtrim(BASE_URL, '/') . '/rents'],
                    ['Resultados de búsqueda', rtrim(BASE_URL, '/') . '/rents']
                ],
                'pageType' => 'rentas-busqueda'
            ]);
        } else {

            $seo = $this->mergeSeoDefaults([
                'title'       => 'Explora casas particulares en Cuba | CuVaRents',
                'description' => 'Explora casas particulares en Cuba: casas, apartamentos y villas. Filtra por destino, capacidad y servicios y reserva por WhatsApp con CuVaRents.',
                'url'         => BASE_URL . 'rents',
                'robots'      => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Alojamientos', rtrim(BASE_URL, '/') . '/rents']
                ],
                'pageType' => 'rentas'
            ]);
        }

        // --- VIEW ---
        require 'src/views/rentas/rentasView.php';
    }

    public function show($id): void
    {
        $renta = $this->rentaModel->getById((int)$id);

        if (!$renta) {
            header("HTTP/1.0 404 Not Found");
            require 'src/views/404View.php';
            return;
        }

        // -----------------------------
        // 1) Canonical: /rents/{slug}-{id}
        // -----------------------------
        $slug = slugify($renta['rental_title'] ?? '');
        if ($slug === '') {
            $slug = 'renta';
        }

        $expectedUrlParam = 'rents/' . $slug . '-' . (int)$renta['rental_id']; // sin slash inicial
        $canonicalUrl     = rtrim(BASE_URL, '/') . '/' . $expectedUrlParam;     // absoluta

        // -----------------------------
        // 2) Redirección 301 si entras por slug incorrecto o /rents/{id}
        // -----------------------------
        $currentUrlParam = trim((string)($_GET['url'] ?? ''), '/');

        if ($currentUrlParam !== $expectedUrlParam) {
            $params = $_GET ?? [];
            unset($params['url']);

            $dest = $canonicalUrl;
            if (!empty($params)) {
                $dest .= '?' . http_build_query($params);
            }

            header("Location: $dest", true, 301);
            exit;
        }

        // -----------------------------
        // 3) Precio
        // -----------------------------
        $priceRaw  = $renta['rental_price'] ?? null;
        $priceText = ($priceRaw === null || trim((string)$priceRaw) === '' || (is_numeric($priceRaw) && (int)$priceRaw === 1))
            ? 'Consultar'
            : ('$' . htmlspecialchars((string)$priceRaw, ENT_QUOTES, 'UTF-8'));

        // -----------------------------
        // 4) SEO
        // -----------------------------
        $seo = $this->mergeSeoDefaults([
            'title'       => htmlspecialchars($renta['rental_title'], ENT_QUOTES, 'UTF-8'),
            'description' => 'Renta en ' . htmlspecialchars($renta['rental_municipio'] ?? '', ENT_QUOTES, 'UTF-8')
                . ', ' . htmlspecialchars($renta['rental_provincia'] ?? '', ENT_QUOTES, 'UTF-8')
                . '. Precio: ' . $priceText . '.',
            'url'         => $canonicalUrl,
            'image'       => !empty($renta['images'][0]) ? BASE_URL . 'uploads/' . $renta['images'][0] : BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'robots'      => 'index, follow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Rentas', BASE_URL . 'rents'],
                [$renta['rental_title'], $canonicalUrl]
            ],
            'pageType' => 'renta-detalle'
        ]);

        // -----------------------------
        // 5) CSS específicos
        // -----------------------------
        $pageStyles = [
            'assets/css/detalle-renta.css',
            'assets/css/glightbox.min.css',
            'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
            'assets/css/nouislider.min.css',
            'assets/css/choices.min.css',
            'assets/css/swiper-bundle.min.css'
        ];

        require 'src/views/rentas/detalleRentaView.php';
    }
}
