<?php
$basePath = BASE_PATH;

if (!isset($seo) || !is_array($seo)) {
  $seo = [];
}

// Sanitizar valores SEO (para evitar warnings de null)
foreach ($seo as $key => $value) {
  if (is_array($value)) continue;
  $seo[$key] = $value ?? '';
}

$canonicalUrl = trim((string)($seo['url'] ?? ''));

$siteUrl = rtrim(BASE_URL, '/') . '/'; // raíz estable
$orgId   = $siteUrl . '#organization';
$webId   = $siteUrl . '#website';

$pageBase = $canonicalUrl !== '' ? rtrim($canonicalUrl, '/') . '/' : $siteUrl;

$pageId       = $pageBase . '#webpage';
$breadcrumbId = $pageBase . '#breadcrumb';

// BreadcrumbList desde $seo['breadcrumb']
$crumbs = [];
if (!empty($seo['breadcrumb']) && is_array($seo['breadcrumb'])) {
  foreach ($seo['breadcrumb'] as $c) {
    if (!is_array($c)) continue;
    $name = (string)($c[0] ?? '');
    $url  = (string)($c[1] ?? '');
    if ($name === '') continue;
    $crumbs[] = ['name' => $name, 'url' => $url];
  }
}

// Si el controller no envía breadcrumb (no debería), dejamos vacío para no inventar.
$itemList = [];
if (!empty($crumbs)) {
  foreach ($crumbs as $i => $c) {
    $li = [
      '@type'    => 'ListItem',
      'position' => $i + 1,
      'name'     => $c['name'],
    ];
    if (!empty($c['url'])) {
      $li['item'] = $c['url'];
    }
    $itemList[] = $li;
  }
}

// Armado del @graph
$schemaGraph = [
  [
    '@type' => 'WebSite',
    '@id'   => $webId,
    'url'   => $siteUrl,
    'name'  => 'CuVaRents',
    'description' => 'Casas particulares, apartamentos, hostales y villas en alquiler en toda Cuba. Reserva por WhatsApp.',
    'publisher' => ['@id' => $orgId],
    'potentialAction' => [
      '@type'  => 'SearchAction',
      'target' => [
        '@type'       => 'EntryPoint',
        'urlTemplate' => $siteUrl . 'rents?search={search_term_string}'
      ],
      'query-input' => 'required name=search_term_string'
    ]
  ],
  [
    '@type' => 'Organization',
    '@id'   => $orgId,
    'name'  => 'CuVaRents',
    'url'   => $siteUrl,
    'logo'  => [
      '@type'  => 'ImageObject',
      'url'    => $siteUrl . 'assets/img/logos/logo_qvarents.svg',
      'width'  => 250,
      'height' => 60
    ],
    'sameAs' => [
      'https://www.facebook.com/people/Agencia-Cuvarents/61560542866042/?mibextid=ZbWKwL',
      'https://www.instagram.com/cuvarents'
    ],
    'contactPoint' => [[
      '@type' => 'ContactPoint',
      'telephone' => '+5353868634',
      'contactType' => 'customer service',
      'availableLanguage' => ['es', 'en'],
      'areaServed' => 'CU'
    ]]
  ],
];

// WebPage solo si el controller envía url/title (lo normal)
if (!empty($seo['title']) || !empty($seo['description']) || $canonicalUrl !== '') {
  $webPageNode = [
    '@type' => 'WebPage',
    '@id'   => $pageId,
    'url'   => $canonicalUrl !== '' ? $canonicalUrl : $siteUrl,
    'name'  => (string)($seo['title'] ?? ''),
    'description' => (string)($seo['description'] ?? ''),
    'isPartOf' => ['@id' => $webId],
    'inLanguage' => 'es',
  ];

  // BreadcrumbList: solo si el controller la envía
  if (!empty($itemList)) {
    $webPageNode['breadcrumb'] = ['@id' => $breadcrumbId];
  }

  $schemaGraph[] = $webPageNode;
}

// BreadcrumbList node (solo si hay breadcrumbs del controller)
if (!empty($itemList)) {
  $schemaGraph[] = [
    '@type' => 'BreadcrumbList',
    '@id'   => $breadcrumbId,
    'itemListElement' => $itemList
  ];
}

$schemaJson = json_encode(
  ['@context' => 'https://schema.org', '@graph' => $schemaGraph],
  JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
);
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>

  <!-- Theme switcher -->
  <script>
    (function() {
      const saved = localStorage.getItem('theme');
      const theme = saved || 'auto';

      const prefersDark =
        window.matchMedia &&
        window.matchMedia('(prefers-color-scheme: dark)').matches;

      const shouldBeDark = theme === 'dark' || (theme === 'auto' && prefersDark);

      document.documentElement.classList.toggle('dark', shouldBeDark);
      document.documentElement.dataset.theme = theme;
    })();
  </script>

  <!-- Google tag (gtag.js) -->
  <script async src="https://www.googletagmanager.com/gtag/js?id=G-GGD7VYB2LG"></script>
  <script>
    window.dataLayer = window.dataLayer || [];

    function gtag() {
      dataLayer.push(arguments);
    }
    gtag('js', new Date());

    gtag('config', 'G-GGD7VYB2LG');
  </script>

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO PRINCIPAL (desde Controller) -->
  <title><?= htmlspecialchars((string)($seo['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?></title>
  <meta name="description" content="<?= htmlspecialchars((string)($seo['description'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="robots" content="<?= htmlspecialchars((string)($seo['robots'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="author" content="CuVaRents">

  <?php if (!empty($canonicalUrl)): ?>
    <link rel="canonical" href="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <?php endif; ?>

  <!-- GEO LOCAL -->
  <meta name="geo.region" content="CU">
  <meta name="geo.placename" content="Cuba">

  <!-- OPEN GRAPH (desde Controller) -->
  <meta property="og:locale" content="<?= htmlspecialchars((string)($seo['locale'] ?? 'es_CU'), ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:type" content="<?= htmlspecialchars((string)($seo['type'] ?? 'website'), ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:title" content="<?= htmlspecialchars((string)($seo['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
  <meta property="og:description" content="<?= htmlspecialchars((string)($seo['description'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
  <?php if (!empty($canonicalUrl)): ?>
    <meta property="og:url" content="<?= htmlspecialchars($canonicalUrl, ENT_QUOTES, 'UTF-8'); ?>">
  <?php endif; ?>
  <meta property="og:site_name" content="CuVaRents">
  <?php if (!empty($seo['image'])): ?>
    <meta property="og:image" content="<?= htmlspecialchars((string)$seo['image'], ENT_QUOTES, 'UTF-8'); ?>">
  <?php endif; ?>
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- TWITTER -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars((string)($seo['title'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars((string)($seo['description'] ?? ''), ENT_QUOTES, 'UTF-8'); ?>">
  <?php if (!empty($seo['image'])): ?>
    <meta name="twitter:image" content="<?= htmlspecialchars((string)$seo['image'], ENT_QUOTES, 'UTF-8'); ?>">
  <?php endif; ?>
  <meta name="twitter:site" content="@CuVaRents">

  <!-- BASE PATH -->
  <base href="<?= htmlspecialchars((string)$basePath, ENT_QUOTES, 'UTF-8'); ?>">

  <!-- ICONOS -->
  <link rel="icon" href="assets/img/favicon-32x32.png" type="image/png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">

  <!-- OPTIMIZACIÓN -->
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">
  <link rel="preload" href="assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin>

  <!-- ESTILOS GLOBALES -->
  <link rel="stylesheet" href="assets/css/index.css">

  <!-- 🔹 ESTILOS ESPECÍFICOS DE CADA PÁGINA -->
  <?php if (isset($pageStyles) && is_array($pageStyles)): ?>
    <?php foreach ($pageStyles as $cssFile): ?>
      <link rel="stylesheet" href="<?= htmlspecialchars((string)$cssFile, ENT_QUOTES, 'UTF-8'); ?>">
    <?php endforeach; ?>
  <?php endif; ?>

  <!-- Cargan css evitando cache con filemtime -->
  <?php
  $cssPath = __DIR__ . '/../assets/css/output.css';
  $cssVer  = file_exists($cssPath) ? filemtime($cssPath) : time();
  ?>
  <link rel="stylesheet" href="assets/css/output.css?v=<?= $cssVer ?>">

  <!-- 🧠 SCHEMA.ORG JSON-LD (dinámico por página) -->
  <script type="application/ld+json">
    <?= $schemaJson ?>
  </script>

  <!-- GLOBAL JS VARS -->
  <script>
    const BASE_URL = "<?= htmlspecialchars((string)BASE_URL, ENT_QUOTES, 'UTF-8'); ?>";
  </script>
</head>