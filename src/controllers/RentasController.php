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
            'title'       => 'Alquiler de Casas en Cuba',
            'description' => 'Encuentra casas particulares y apartamentos en alquiler en toda Cuba. Reserva segura con CuVaRents.',
            'keywords'    => 'alquiler casas cuba, rentas cuba, casas particulares, apartamentos cuba, cuvarents',
            'url'         => BASE_URL,
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_ES',
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

        //Verificar si es paginada para robots
        $isPaginated = ($page > 1);
        $robotsForLists = $isPaginated ? 'noindex, follow' : 'index, follow';

        $itemsPerPage = 12;
        $offset       = ($page - 1) * $itemsPerPage;

        $homeSearch = trim($_GET['search'] ?? '');

        // --- CONTEXTO PRO ---
        $categoriaSlug = $_GET['categoria'] ?? '';
        $provinciaSlug = $_GET['provincia_slug'] ?? '';
        $municipioSlug = $_GET['municipio_slug'] ?? '';

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

        $rents       = $rentsData['rentas'] ?? [];
        $totalPages  = $rentsData['totalPages'] ?? 1;

        // Si tu view lo usa, aquí puedes calcularlo real con el COUNT.
        // Como tu Search devuelve totalPages pero no total, lo dejamos null para no mentir.
        $totalResults = null;

        // -------- SEO --------
        if ($categoriaNombre !== '') {
            $seo = $this->mergeSeoDefaults([
                'title'       => "$categoriaNombre en Cuba | Casas particulares | CuVaRents",
                'description' => "Descubre rentas de $categoriaNombre en Cuba. Casas particulares y alojamientos para tu viaje.",
                'keywords'    => "rentas $categoriaNombre, casas particulares $categoriaNombre, alojamiento $categoriaNombre, cuvarents",
                'url'         => BASE_URL . "rents/$categoriaSlug",
                'robots' => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Rentas', BASE_URL . 'rents'],
                    [$categoriaNombre, BASE_URL . "rents/$categoriaSlug"]
                ],
                'pageType' => 'rentas-categoria'
            ]);
        } elseif ($provinciaSlug !== '') {
            $seo = $this->mergeSeoDefaults([
                'title'       => "Casas particulares en $provinciaNombre | CuVaRents",
                'description' => "Encuentra casas particulares y rentas en la provincia de $provinciaNombre. Explora municipios y elige tu alojamiento ideal.",
                'keywords'    => "rentas en $provinciaNombre, casas particulares $provinciaNombre, alquiler $provinciaNombre, cuvarents",
                'url'         => BASE_URL . "rents/provincias/$provinciaSlug",
                'robots' => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Rentas', BASE_URL . 'rents'],
                    ['Provincias', BASE_URL . 'rents/provincias'],
                    [$provinciaNombre, BASE_URL . "rents/provincias/$provinciaSlug"]
                ],
                'pageType' => 'rentas-provincia'
            ]);
        } elseif ($municipioSlug !== '') {
            $seo = $this->mergeSeoDefaults([
                'title'       => "Casas particulares en $municipioNombre | CuVaRents",
                'description' => "Descubre casas particulares y alojamientos en $municipioNombre. Reserva con confianza y vive Cuba a tu manera.",
                'keywords'    => "rentas en $municipioNombre, casas particulares $municipioNombre, alojamiento $municipioNombre, cuvarents",
                'url'         => BASE_URL . "rents/municipios/$municipioSlug",
                'robots' => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Rentas', BASE_URL . 'rents'],
                    ['Municipios', BASE_URL . 'rents/municipios'],
                    [$municipioNombre, BASE_URL . "rents/municipios/$municipioSlug"]
                ],
                'pageType' => 'rentas-municipio'
            ]);
        } elseif ($hasFilters || $homeSearch !== '') {
            $seo = $this->mergeSeoDefaults([
                'title'       => 'Resultados de búsqueda | CuVaRents',
                'description' => 'Explora casas particulares y apartamentos en Cuba según tus preferencias.',
                'url'         => BASE_URL . 'rents',
                'robots'      => 'noindex, follow',
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Rentas', BASE_URL . 'rents'],
                    ['Resultados de búsqueda', BASE_URL . 'rents']
                ],
                'pageType' => 'rentas-busqueda'
            ]);
        } else {
            $seo = $this->mergeSeoDefaults([
                'title'       => 'Explorar Rentas en Cuba | CuVaRents',
                'description' => 'Explora casas particulares, apartamentos y alojamientos en Cuba. Encuentra la renta ideal para tu viaje.',
                'url'         => BASE_URL . 'rents',
                'robots' => $robotsForLists,
                'breadcrumb'  => [
                    ['Inicio', BASE_URL],
                    ['Rentas', BASE_URL . 'rents']
                ],
                'pageType' => 'rentas'
            ]);
        }

        // --- Texto SEO (config/zonas-seo.php) ---
        // Para no crear "basura", reutilizamos tu único archivo:
        // - Provincias: se intenta por slug (ej: la-habana, santiago-de-cuba)
        // - Municipios: también por slug (ej: varadero, trinidad, vinales)
        $zonaSeo = [];
        if ($provinciaSlug !== '' || $municipioSlug !== '') {
            $zonasSeoConfig = require __DIR__ . '/../../config/zonas-seo.php';
            $key = $provinciaSlug !== '' ? $provinciaSlug : $municipioSlug;
            $zonaSeo = $zonasSeoConfig[$key] ?? [];
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

        $priceRaw = $renta['rental_price'] ?? null;
        $priceText = ($priceRaw === null || trim((string)$priceRaw) === '' || (is_numeric($priceRaw) && (int)$priceRaw === 1))
            ? 'Consultar'
            : ('$' . htmlspecialchars((string)$priceRaw, ENT_QUOTES, 'UTF-8'));

        $seo = $this->mergeSeoDefaults([
            'title'       => htmlspecialchars($renta['rental_title'], ENT_QUOTES, 'UTF-8'),
            'description' => 'Renta en ' . htmlspecialchars($renta['rental_municipio'] ?? '', ENT_QUOTES, 'UTF-8')
                . ', ' . htmlspecialchars($renta['rental_provincia'] ?? '', ENT_QUOTES, 'UTF-8')
                . '. Precio: ' . $priceText . '.',
            'url'         => BASE_URL . 'rents/' . $renta['rental_id'],
            'image'       => !empty($renta['images'][0]) ? BASE_URL . 'uploads/' . $renta['images'][0] : BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'robots'      => 'index, follow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Rentas', BASE_URL . 'rents'],
                [$renta['rental_title'], BASE_URL . 'rents/' . $renta['rental_id']]
            ],
            'pageType' => 'renta-detalle'
        ]);

        $pageStyles = [
            'assets/css/detalle-renta.css',
            'assets/css/glightbox.min.css',
            'https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css',
            'assets/css/nouislider.min.css',
            'assets/css/choices.min.css'
        ];

        require 'src/views/rentas/detalleRentaView.php';
    }
}
