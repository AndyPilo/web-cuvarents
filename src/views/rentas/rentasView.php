<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body class="bg-gray-50 dark:bg-gray-900">
  <?php include_once __DIR__ . '/../../../includes/navbar.php'; ?>

  <?php
  // -----------------------------------------
  // CONTEXTO SEO + URL PARA PAGINACIÓN
  // -----------------------------------------
  $categoriaSlug  = $_GET['categoria'] ?? null;
  $provinciaSlug  = $_GET['provincia_slug'] ?? null;
  $municipioSlug  = $_GET['municipio_slug'] ?? null;

  $page = isset($page) ? (int)$page : (int)($_GET['page'] ?? 1);
  $page = max(1, $page);

  $pretty = fn($s) => ucwords(str_replace('-', ' ', (string)$s));

  if ($categoriaSlug) {
    $basePath     = rtrim(BASE_URL, '/') . '/rents/' . $categoriaSlug;
    $contextTitle = 'Rentas de ' . $pretty($categoriaSlug);
  } elseif ($provinciaSlug) {
    $basePath     = rtrim(BASE_URL, '/') . '/rents/provincias/' . $provinciaSlug;
    $contextTitle = 'Rentas en ' . $pretty($provinciaSlug);
  } elseif ($municipioSlug) {
    $basePath     = rtrim(BASE_URL, '/') . '/rents/municipios/' . $municipioSlug;
    $contextTitle = 'Rentas en ' . $pretty($municipioSlug);
  } else {
    $basePath     = rtrim(BASE_URL, '/') . '/rents';
    $contextTitle = 'Todas las Rentas';
  }

  // Query string para paginación (conservar filtros)
  $query = $_GET;
  unset(
    $query['page'],
    $query['url'],
    $query['categoria'],
    $query['provincia_slug'],
    $query['municipio_slug']
  );
  $queryString = http_build_query($query);
  $queryPrefix = strlen($queryString) ? ('?' . $queryString) : '';

  function paginationRange(int $page, int $totalPages, int $maxPages): array
  {
    $maxPages = max(1, min($maxPages, $totalPages));

    $halfLeft  = intdiv($maxPages, 2);
    $halfRight = $maxPages - $halfLeft - 1;

    $start = max(1, $page - $halfLeft);
    $end   = min($totalPages, $page + $halfRight);

    $currentCount = $end - $start + 1;
    if ($currentCount < $maxPages) {
      $missing = $maxPages - $currentCount;
      $start = max(1, $start - $missing);
      $currentCount = $end - $start + 1;

      if ($currentCount < $maxPages) {
        $end = min($totalPages, $end + ($maxPages - $currentCount));
      }
    }

    return [$start, $end];
  }

  // -----------------------------------------
  // BREADCRUMBS
  // -----------------------------------------
  $crumbs = [
    ['label' => 'Inicio', 'url' => BASE_URL, 'home' => true],
    ['label' => 'Rentas', 'url' => rtrim(BASE_URL, '/') . '/rents'],
  ];

  if ($categoriaSlug) {
    $crumbs[] = ['label' => $pretty($categoriaSlug), 'url' => $basePath];
  } elseif ($provinciaSlug) {
    $crumbs[] = ['label' => 'Provincias', 'url' => rtrim(BASE_URL, '/') . '/rents'];
    $crumbs[] = ['label' => $pretty($provinciaSlug), 'url' => $basePath];
  } elseif ($municipioSlug) {
    $crumbs[] = ['label' => 'Municipios', 'url' => rtrim(BASE_URL, '/') . '/rents'];
    $crumbs[] = ['label' => $pretty($municipioSlug), 'url' => $basePath];
  } else {
    $crumbs[] = ['label' => 'Todas', 'url' => null];
  }

  if ($page > 1) {
    $crumbs[] = ['label' => 'Página ' . $page, 'url' => null];
  }

  $lastIndex = count($crumbs) - 1;

  // -----------------------------------------
  // Helpers SEO (contenido y schemas)
  // -----------------------------------------
  $robotsMeta = (string)($seo['robots'] ?? '');
  $isIndexable = (stripos($robotsMeta, 'noindex') === false) && ($page === 1);

  // Zona SEO: compat + nuevos campos
  $hasZonaSeo  = !empty($zonaSeo) && is_array($zonaSeo);
  $introTop    = $hasZonaSeo ? (string)($zonaSeo['intro_top'] ?? $zonaSeo['intro'] ?? '') : '';
  $introBottom = $hasZonaSeo ? (string)($zonaSeo['intro_bottom'] ?? '') : '';
  $sections    = $hasZonaSeo && !empty($zonaSeo['sections']) && is_array($zonaSeo['sections']) ? $zonaSeo['sections'] : [];
  $faq         = $hasZonaSeo && !empty($zonaSeo['faq']) && is_array($zonaSeo['faq']) ? $zonaSeo['faq'] : [];
  $links       = $hasZonaSeo && !empty($zonaSeo['links']) && is_array($zonaSeo['links']) ? $zonaSeo['links'] : [];
  ?>

  <main class="min-h-screen">

    <nav class="mx-auto my-6 max-w-7xl px-4 sm:px-6 lg:px-8 mb-4" aria-label="Breadcrumb">
      <ol class="inline-flex items-center space-x-1 md:space-x-2 text-sm lg:justify-start justify-center w-full">
        <?php foreach ($crumbs as $i => $c): ?>
          <li
            class="inline-flex items-center <?php echo $i > 0 ? 'space-x-1.5' : ''; ?>"
            <?php echo ($i === $lastIndex) ? 'aria-current="page"' : ''; ?>>
            <?php if ($i > 0): ?>
              <svg class="w-3.5 h-3.5 rtl:rotate-180 text-gray-400 dark:text-gray-500" aria-hidden="true"
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7" />
              </svg>
            <?php endif; ?>

            <?php if (!empty($c['url']) && $i !== $lastIndex): ?>
              <a href="<?= $c['url'] ?>"
                class="inline-flex items-center text-sm font-medium text-gray-500 dark:text-gray-400 hover:text-blue-800 dark:hover:text-blue-400 transition-colors">
                <?php if (!empty($c['home'])): ?>
                  <svg class="w-4 h-4 me-1.5" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="m4 12 8-8 8 8M6 10.5V19a1 1 0 0 0 1 1h3v-3a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v3h3a1 1 0 0 0 1-1v-8.5" />
                  </svg>
                <?php endif; ?>

                <span class="truncate max-w-[180px] sm:max-w-xs">
                  <?= htmlspecialchars($c['label']) ?>
                </span>
              </a>
            <?php else: ?>
              <span class="inline-flex items-center text-sm font-semibold text-gray-900 dark:text-white">
                <span class="truncate max-w-[180px] sm:max-w-xs">
                  <?= htmlspecialchars($c['label']) ?>
                </span>
              </span>
            <?php endif; ?>
          </li>
        <?php endforeach; ?>
      </ol>
    </nav>


    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
      <div class="mb-8">
        <?php if ($hasZonaSeo): ?>
          <div class="text-center lg:text-left">
            <div class="inline-flex items-center justify-center mb-4">
              <span class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/30 dark:to-blue-900/30 px-4 py-2">
                <span class="mr-2 h-2 w-2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500"></span>
                <span class="text-sm font-medium text-cyan-800 dark:text-cyan-300">
                  <?= htmlspecialchars($zonaSeo['subtitle'] ?? 'Destino') ?>
                </span>
              </span>
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl lg:text-5xl mb-4">
              <?= htmlspecialchars($zonaSeo['h1'] ?? $contextTitle) ?>
            </h1>

            <?php if ($introTop !== ''): ?>
              <p class="my-12 text-lg text-gray-600 dark:text-gray-300 lg:text-left">
                <?= nl2br(htmlspecialchars($introTop)) ?>
              </p>
            <?php endif; ?>

            <?php include_once __DIR__ . '/searchRent.php'; ?>


            <?php if (!empty($links)): ?>
              <div class="mt-6">
                <h2 class="sr-only">Explorar también</h2>
                <div class="flex flex-wrap gap-2 justify-center lg:justify-start">
                  <?php foreach ($links as $l): ?>
                    <?php
                    $label = (string)($l['label'] ?? '');
                    $url   = (string)($l['url'] ?? '');
                    if ($label === '' || $url === '') continue;
                    ?>
                    <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>"
                      class="inline-flex items-center rounded-full border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-800 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-200 hover:border-cyan-400 dark:hover:border-cyan-500 hover:text-cyan-700 dark:hover:text-cyan-400 transition-colors">
                      <?= htmlspecialchars($label, ENT_QUOTES, 'UTF-8') ?>
                    </a>
                  <?php endforeach; ?>
                </div>
              </div>
            <?php endif; ?>
          </div>
        <?php else: ?>
          <div class="text-center lg:text-left">
            <div class="inline-flex items-center justify-center mb-4">
              <span class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/30 dark:to-blue-900/30 px-4 py-2">
                <span class="mr-2 h-2 w-2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500"></span>
                <span class="text-sm font-medium text-cyan-800 dark:text-cyan-300">Propiedades disponibles</span>
              </span>
            </div>

            <h1 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl lg:text-5xl mb-4">
              <span class="block bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 bg-clip-text text-transparent">
                <?= htmlspecialchars($contextTitle) ?>
              </span>

              <?php if (!empty($totalResults)): ?>
                <span class="block bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 bg-clip-text text-transparent">
                  <?= $totalResults ?> propiedades
                </span>
              <?php endif; ?>
            </h1>

            <?php if (!empty($totalResults) && $totalResults > 0): ?>
              <p class="text-lg text-gray-600 dark:text-gray-300">
                Encuentra la propiedad perfecta para tu estancia en Cuba
              </p>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>

      <div class="w-full">

        <?php if (empty($rents)): ?>
          <div class="rounded-2xl bg-gradient-to-br from-gray-50 to-white dark:from-gray-800 dark:to-gray-900 p-12 text-center shadow-sm dark:shadow-gray-800/30">
            <div class="mx-auto max-w-md">
              <svg class="mx-auto h-16 w-16 text-gray-400 dark:text-gray-500 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
              </svg>

              <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">No encontramos propiedades</h2>
              <p class="text-gray-600 dark:text-gray-300 mb-8">
                Prueba ajustando los filtros de búsqueda o explorando otros destinos de Cuba
              </p>

              <a href="<?= BASE_URL ?>rents"
                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500
                        px-8 py-3 text-base font-semibold text-white shadow-lg transition-all
                        hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl hover:-translate-y-0.5">
                <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                </svg>
                Ver todas las propiedades
              </a>
            </div>
          </div>

        <?php else: ?>

          <?php
          // -----------------------------------------
          // JSON-LD adicional (solo si indexable)
          // - ItemList del listado
          // - FAQPage (si aplica)
          // -----------------------------------------
          require_once 'utils/slugify.php';

          if ($isIndexable) {
            // ItemList
            $itemList = [
              '@context' => 'https://schema.org',
              '@type' => 'ItemList',
              'name' => (string)($zonaSeo['h1'] ?? $contextTitle),
              'itemListElement' => []
            ];

            foreach ($rents as $idx => $row) {
              $rentalTitle = (string)($row['rental_title'] ?? '');
              $rentalId    = (int)($row['rental_id'] ?? 0);
              $slug        = slugify($rentalTitle);
              $url         = rtrim(BASE_URL, '/') . "/rents/" . $slug . "-" . $rentalId;

              $images = !empty($row['images']) ? explode(',', (string)$row['images']) : [];
              $img    = !empty($images[0]) ? (rtrim(BASE_URL, '/') . '/uploads/' . $images[0]) : (rtrim(BASE_URL, '/') . '/assets/img/og-image-cuvarents.jpg');

              $itemList['itemListElement'][] = [
                '@type' => 'ListItem',
                'position' => $idx + 1,
                'url' => $url,
                'item' => [
                  '@type' => 'LodgingBusiness',
                  'name' => $rentalTitle,
                  'url' => $url,
                  'image' => $img,
                  'address' => [
                    '@type' => 'PostalAddress',
                    'addressCountry' => 'CU',
                    'addressRegion' => (string)($row['rental_provincia'] ?? ''),
                    'addressLocality' => (string)($row['rental_municipio'] ?? ''),
                  ],
                ],
              ];
            }

            echo '<script type="application/ld+json">' . json_encode($itemList, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';

            // FAQPage
            if (!empty($faq)) {
              $faqSchema = [
                '@context' => 'https://schema.org',
                '@type' => 'FAQPage',
                'mainEntity' => []
              ];

              foreach ($faq as $f) {
                $q = trim((string)($f['q'] ?? ''));
                $a = trim((string)($f['a'] ?? ''));
                if ($q === '' || $a === '') continue;

                $faqSchema['mainEntity'][] = [
                  '@type' => 'Question',
                  'name' => $q,
                  'acceptedAnswer' => [
                    '@type' => 'Answer',
                    'text' => $a
                  ]
                ];
              }

              if (!empty($faqSchema['mainEntity'])) {
                echo '<script type="application/ld+json">' . json_encode($faqSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) . '</script>';
              }
            }
          }
          ?>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <?php foreach ($rents as $row):
              $rentalId    = $row['rental_id'];
              $images      = !empty($row['images']) ? explode(',', $row['images']) : [];
              $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
              $rentalHab   = htmlspecialchars($row['rental_rooms'] ?? '', ENT_QUOTES, 'UTF-8');
              $provincia   = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
              $municipio   = htmlspecialchars($row['rental_municipio'], ENT_QUOTES, 'UTF-8');
              $isPromoted  = $row['is_promoted'] ?? 0;
              $capacity    = $row['rental_capacity'] ?? 0;

              $rentalPriceRaw  = $row['rental_price'] ?? '';
              $rentalPriceType = htmlspecialchars($row['rental_price_type'] ?? '', ENT_QUOTES, 'UTF-8');

              $priceNum = is_numeric($rentalPriceRaw) ? (float)$rentalPriceRaw : null;

              if ($priceNum !== null && (int)$priceNum === 1) {
                $rentalPriceDisplay = '$ Consultar';
                $rentalPriceType = '';
              } elseif ($rentalPriceRaw === null || trim((string)$rentalPriceRaw) === '') {
                $rentalPriceDisplay = '$ Consultar';
                $rentalPriceType = '';
              } else {
                $rentalPriceDisplay = '$' . htmlspecialchars(trim((string)$rentalPriceRaw), ENT_QUOTES, 'UTF-8');
              }

              $slug = slugify($rentalTitle);
              $url  = rtrim(BASE_URL, '/') . "/rents/" . $slug . "-" . $rentalId;

              $cardImage = !empty($images[0])
                ? BASE_URL . 'uploads/' . $images[0]
                : BASE_URL . 'assets/img/default-img.png';
            ?>

              <article
                class="group relative flex flex-col overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg dark:shadow-gray-900/50
         ring-1 ring-gray-200/50 dark:ring-gray-700/50 transition-all duration-300
         hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-gray-900 hover:ring-gray-300/80 dark:hover:ring-gray-600/80"
                itemscope
                itemtype="https://schema.org/Accommodation">

                <!-- Overlay: hace toda la card clickeable -->
                <a href="<?= $url ?>"
                  class="absolute inset-0 z-50"
                  aria-label="<?= htmlspecialchars($rentalTitle, ENT_QUOTES, 'UTF-8') ?>">
                </a>

                <!-- Imagen -->
                <div class="relative block overflow-hidden aspect-square no-underline z-20">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent z-10"></div>

                  <img src="<?= $cardImage ?>" alt="<?= $rentalTitle ?>" loading="lazy"
                    itemprop="image"
                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">

                  <?php if ($isPromoted): ?>
                    <div class="absolute top-3 left-3 z-20">
                      <div class="flex items-center gap-1.5 rounded-full 
          bg-gradient-to-r from-yellow-300/60 to-yellow-200 dark:from-yellow-500/60 dark:to-yellow-400
          backdrop-blur-sm border border-yellow-200/50 dark:border-yellow-400/50
          px-3 py-1.5 group">
                        <svg class="h-3.5 w-3.5 text-yellow-900 dark:text-yellow-900" fill="currentColor" viewBox="0 0 20 20">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                        </svg>
                        <span class="text-xs font-semibold text-yellow-900 dark:text-yellow-900 group-hover:text-yellow-800">
                          VIP
                        </span>
                      </div>
                    </div>
                  <?php endif; ?>

                  <div class="absolute top-3 right-3 z-20">
                    <div class="flex items-center gap-1.5 rounded-full 
        bg-gradient-to-r from-slate-100 to-slate-200 dark:from-gray-700 dark:to-gray-800
        backdrop-blur-sm border border-gray-200 dark:border-gray-600 px-3 py-1.5 group">
                      <span class="text-sm font-bold text-gray-900 dark:text-white"><?= $rentalPriceDisplay ?></span>
                      <?php if (!empty($rentalPriceType)): ?>
                        <span class="text-xs text-gray-700 dark:text-gray-300 ml-1"><?= $rentalPriceType ?></span>
                      <?php endif; ?>
                    </div>
                  </div>

                  <div class="absolute inset-0 bg-gradient-to-t from-cyan-900/30 dark:from-cyan-900/50 via-transparent to-transparent
                opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-10"></div>
                </div>

                <!-- Contenido -->
                <div class="flex flex-col flex-grow p-4 relative z-20">
                  <h3 class="text-sm font-semibold text-gray-900 dark:text-white line-clamp-2 mb-2 group-hover:text-cyan-700 dark:group-hover:text-cyan-400 transition-colors"
                    itemprop="name">
                    <?= $rentalTitle ?>
                  </h3>

                  <div class="flex items-center gap-1.5 text-xs text-gray-500 dark:text-gray-400 mb-3">
                    <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span class="truncate"><?= $provincia ?>, <?= $municipio ?></span>
                  </div>

                  <div class="flex items-center gap-4 text-xs text-gray-500 dark:text-gray-400 mb-3">
                    <?php if (!empty($rentalHab)): ?>
                      <div class="flex items-center gap-1">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                        <span><?= $rentalHab ?> hab.</span>
                      </div>
                    <?php endif; ?>

                    <?php if (!empty($capacity)): ?>
                      <div class="flex items-center gap-1">
                        <svg class="h-3.5 w-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 01112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13 0h1m-1 1v1" />
                        </svg>
                        <span><?= $capacity ?> pers.</span>
                      </div>
                    <?php endif; ?>
                  </div>

                  <?php if (!empty($row['service_data']) || !empty($row['service_icons'])): ?>
                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="false">
                      <?php
                      if (!empty($row['service_data'])) {
                        $raw = $row['service_data'];
                        $pairs = array_filter(explode('||', $raw));
                        $pairs = array_slice($pairs, 0, 6);
                        foreach ($pairs as $p) {
                          $parts = explode('::', $p, 2);
                          $icon = trim($parts[0] ?? '');
                          $name = htmlspecialchars(trim($parts[1] ?? ''), ENT_QUOTES, 'UTF-8');
                          if ($icon !== '') {
                            echo '<span class="inline-flex items-center" title="' . $name . '">' . trim($icon) . '</span>';
                          }
                        }
                      } else {
                        $iconsRaw = $row['service_icons'];
                        $iconsArr = array_filter(explode('|', $iconsRaw));
                        $iconsArr = array_slice($iconsArr, 0, 6);
                        foreach ($iconsArr as $ic) {
                          echo trim($ic);
                        }
                      }
                      ?>
                    </div>
                  <?php endif; ?>
                </div>
              </article>

            <?php endforeach; ?>
          </div>

          <?php if (!empty($totalPages) && $totalPages > 1): ?>
            <?php
            $maxPages = 6;
            [$start, $end] = paginationRange($page, (int)$totalPages, $maxPages);
            ?>

            <nav class="mt-12 pt-8 border-t border-gray-200 dark:border-gray-700" aria-label="Navegación de páginas">
              <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
                <div class="text-sm text-gray-500 dark:text-gray-400">
                  Página <?= $page ?> de <?= $totalPages ?> •
                  <?= $totalResults ?? 'Varias' ?> propiedades encontradas
                </div>

                <div class="w-full sm:w-auto overflow-x-auto">
                  <ul class="flex w-max flex-row items-center gap-1 px-1">

                    <?php if ($page > 1): ?>
                      <li>
                        <a href="<?=
                                  $prevUrl = (($page - 1) === 1)
                                    ? ($basePath . $queryPrefix)
                                    : ($basePath . '/page/' . ($page - 1) . $queryPrefix); ?>"
                          class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 dark:border-gray-600
                                  bg-white dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-300 transition-all
                                  hover:border-cyan-500 dark:hover:border-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/30 hover:text-cyan-700 dark:hover:text-cyan-400 hover:shadow-sm"
                          aria-label="Página anterior">
                          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M15 19l-7-7 7-7" />
                          </svg>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php for ($i = $start; $i <= $end; $i++): ?>
                      <?php
                      $pageUrl = ($i === 1)
                        ? ($basePath . $queryPrefix)
                        : ($basePath . '/page/' . $i . $queryPrefix); ?>
                      <li>
                        <a href="<?= $pageUrl ?>"
                          class="inline-flex h-10 w-10 items-center justify-center rounded-full border text-sm transition-all
                            <?= $i === $page
                              ? 'bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 text-white border-cyan-700 dark:border-cyan-600 shadow-md'
                              : 'bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 border-gray-300 dark:border-gray-600 hover:border-cyan-500 dark:hover:border-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/30 hover:text-cyan-700 dark:hover:text-cyan-400' ?>">
                          <?= $i ?>
                        </a>
                      </li>
                    <?php endfor; ?>

                    <?php if ($page < $totalPages): ?>
                      <li>
                        <a href="<?= $basePath . '/page/' . ($page + 1) . $queryPrefix ?>"
                          class="inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 dark:border-gray-600
                                  bg-white dark:bg-gray-800 text-sm text-gray-700 dark:text-gray-300 transition-all
                                  hover:border-cyan-500 dark:hover:border-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/30 hover:text-cyan-700 dark:hover:text-cyan-400 hover:shadow-sm"
                          aria-label="Página siguiente">
                          <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 5l7 7-7 7" />
                          </svg>
                        </a>
                      </li>
                    <?php endif; ?>
                  </ul>
                </div>
              </div>
            </nav>
          <?php endif; ?>

          <?php if ($hasZonaSeo && ($introBottom !== '' || !empty($sections) || !empty($faq))): ?>
            <section class="mt-14 pt-10 border-t border-gray-200 dark:border-gray-700">
              <div class="max-w-4xl">
                <?php if (!empty($sections)): ?>
                  <?php foreach ($sections as $block): ?>
                    <?php
                    $h2 = trim((string)($block['h2'] ?? ''));
                    $p  = trim((string)($block['p'] ?? ''));
                    if ($h2 === '' || $p === '') continue;
                    ?>
                    <div class="mb-10">
                      <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-3">
                        <?= htmlspecialchars($h2, ENT_QUOTES, 'UTF-8') ?>
                      </h2>
                      <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                        <?= nl2br(htmlspecialchars($p, ENT_QUOTES, 'UTF-8')) ?>
                      </p>
                    </div>
                  <?php endforeach; ?>
                <?php endif; ?>

                <?php if ($introBottom !== ''): ?>
                  <div class="mb-10">
                    <p class="text-gray-600 dark:text-gray-300 leading-relaxed">
                      <?= nl2br(htmlspecialchars($introBottom, ENT_QUOTES, 'UTF-8')) ?>
                    </p>
                  </div>
                <?php endif; ?>

                <?php if (!empty($faq)): ?>
                  <div class="mt-10">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">
                      Preguntas frecuentes
                    </h2>

                    <div class="space-y-4">
                      <?php foreach ($faq as $f): ?>
                        <?php
                        $q = trim((string)($f['q'] ?? ''));
                        $a = trim((string)($f['a'] ?? ''));
                        if ($q === '' || $a === '') continue;
                        ?>
                        <details class="rounded-2xl bg-white dark:bg-gray-800 p-5 ring-1 ring-gray-200/60 dark:ring-gray-700/60 shadow-sm">
                          <summary class="cursor-pointer font-semibold text-gray-900 dark:text-white">
                            <?= htmlspecialchars($q, ENT_QUOTES, 'UTF-8') ?>
                          </summary>
                          <p class="mt-3 text-gray-600 dark:text-gray-300 leading-relaxed">
                            <?= nl2br(htmlspecialchars($a, ENT_QUOTES, 'UTF-8')) ?>
                          </p>
                        </details>
                      <?php endforeach; ?>
                    </div>
                  </div>
                <?php endif; ?>
              </div>
            </section>
          <?php endif; ?>

        <?php endif; ?>
      </div>
    </div>
  </main>

  <script src="<?= BASE_URL ?>assets/js/ui-offcanvas-filters.js"></script>
  <?php include_once __DIR__ . '/../../../includes/footer.php'; ?>

  <script src="<?= BASE_URL ?>assets/js/choices.min.js" defer></script>
  <script src="<?= BASE_URL ?>assets/js/nouislider.min.js" defer></script>

</body>

</html>