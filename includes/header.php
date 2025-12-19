<?php

// Aquí NO se inicia sesión, ya está gestionado en bootstrap.php
$basePath = BASE_PATH;

// =============================
// 🔧 SEO: Valores por defecto
// =============================
$seo = $seo ?? [
  'title' => 'CuVaRents | Alquiler de Casas en Cuba',
  'description' => 'Encuentra casas particulares y apartamentos en alquiler en toda Cuba. +500 propiedades verificadas. Reserva segura con CuVaRents.',
  'keywords' => 'alquiler casas cuba, rentas cuba, casas particulares, apartamentos cuba, cuvarents',
  'url' => BASE_URL,
  'image' => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
  'type' => 'website',
  'locale' => 'es_ES',
  'robots' => 'index, follow',
  'breadcrumb' => [['Inicio', BASE_URL]],
  'pageType' => 'general'
];

// Sanitizar valores SEO (para evitar warnings de null)
foreach ($seo as $key => $value) {
  if (is_array($value)) continue;
  $seo[$key] = $value ?? '';
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- SEO PRINCIPAL -->
  <title><?= htmlspecialchars($seo['title']); ?></title>
  <meta name="description" content="<?= htmlspecialchars($seo['description']); ?>">
  <meta name="keywords" content="<?= htmlspecialchars($seo['keywords']); ?>">
  <meta name="robots" content="<?= htmlspecialchars($seo['robots']); ?>">
  <meta name="author" content="CuVaRents">
  <meta name="language" content="Spanish">
  <link rel="canonical" href="<?= htmlspecialchars($seo['url']); ?>">

  <!-- GEO LOCAL -->
  <meta name="geo.region" content="CU">
  <meta name="geo.placename" content="Cuba">

  <!-- OPEN GRAPH -->
  <meta property="og:locale" content="<?= htmlspecialchars($seo['locale']); ?>">
  <meta property="og:type" content="<?= htmlspecialchars($seo['type']); ?>">
  <meta property="og:title" content="<?= htmlspecialchars($seo['title']); ?>">
  <meta property="og:description" content="<?= htmlspecialchars($seo['description']); ?>">
  <meta property="og:url" content="<?= htmlspecialchars($seo['url']); ?>">
  <meta property="og:site_name" content="CuVaRents">
  <meta property="og:image" content="<?= htmlspecialchars($seo['image']); ?>">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <!-- TWITTER -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= htmlspecialchars($seo['title']); ?>">
  <meta name="twitter:description" content="<?= htmlspecialchars($seo['description']); ?>">
  <meta name="twitter:image" content="<?= htmlspecialchars($seo['image']); ?>">
  <meta name="twitter:site" content="@CuVaRents">

  <!-- BASE PATH -->
  <base href="<?= $basePath; ?>">

  <!-- ICONOS -->
  <link rel="icon" href="assets/img/favicon-32x32.png" type="image/png">
  <link rel="apple-touch-icon" sizes="180x180" href="assets/img/apple-touch-icon.png">

  <!-- OPTIMIZACIÓN -->
  <link rel="preconnect" href="https://cdnjs.cloudflare.com">
  <link rel="preload" href="assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin>

  <!-- FONT -->

  <!-- ESTILOS GLOBALES -->
  <link rel="stylesheet" href="assets/css/finder-icons.min.css">
  <link rel="stylesheet" href="assets/css/swiper-bundle.min.css">

  <link rel="stylesheet" href="assets/css/index.css">

  <!-- 🔹 ESTILOS ESPECÍFICOS DE CADA PÁGINA -->
  <?php if (isset($pageStyles) && is_array($pageStyles)): ?>
    <?php foreach ($pageStyles as $cssFile): ?>
      <link rel="stylesheet" href="<?= htmlspecialchars($cssFile); ?>">
    <?php endforeach; ?>
  <?php endif; ?>

  <link rel="stylesheet" href="assets/css/output.css">

  <!-- 🧠 SCHEMA.ORG JSON-LD -->
  <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@graph": [{
          "@type": "WebSite",
          "@id": "https://cuvarents.com/#website",
          "url": "https://cuvarents.com/",
          "name": "CuVaRents - Alquiler de Casas en Cuba",
          "description": "Plataforma líder de alquileres particulares en Cuba",
          "potentialAction": {
            "@type": "SearchAction",
            "target": "https://cuvarents.com/search?query={search_term_string}",
            "query-input": "required name=search_term_string"
          },
          "publisher": {
            "@id": "https://cuvarents.com/#organization"
          }
        },
        {
          "@type": "Organization",
          "@id": "https://cuvarents.com/#organization",
          "name": "CuVaRents",
          "url": "https://cuvarents.com/",
          "logo": {
            "@type": "ImageObject",
            "url": "https://cuvarents.com/assets/img/logos/logo_qvarents.svg",
            "width": 250,
            "height": 60
          },
          "sameAs": [
            "https://www.facebook.com/cuvarents",
            "https://www.instagram.com/cuvarents",
            "https://twitter.com/cuvarents"
          ],
          "contactPoint": {
            "@type": "ContactPoint",
            "telephone": "+53-5-234-5678",
            "contactType": "customer service",
            "availableLanguage": ["Spanish", "English"],
            "areaServed": "CU"
          }
        },
        {
          "@type": "WebPage",
          "@id": "<?= htmlspecialchars($seo['url']); ?>#webpage",
          "url": "<?= htmlspecialchars($seo['url']); ?>",
          "name": "<?= htmlspecialchars($seo['title']); ?>",
          "description": "<?= htmlspecialchars($seo['description']); ?>",
          "isPartOf": {
            "@id": "https://cuvarents.com/#website"
          },
          "inLanguage": "es-ES"
        },
        {
          "@type": "BreadcrumbList",
          "@id": "<?= htmlspecialchars($seo['url']); ?>#breadcrumb",
          "itemListElement": [
            <?php foreach ($seo['breadcrumb'] as $i => $item): ?> {
                "@type": "ListItem",
                "position": <?= $i + 1 ?>,
                "name": "<?= htmlspecialchars($item[0]); ?>",
                "item": "<?= htmlspecialchars($item[1]); ?>"
              }
              <?= $i + 1 < count($seo['breadcrumb']) ? ',' : '' ?>
            <?php endforeach; ?>
          ]
        }
      ]
    }
  </script>

  <!-- GLOBAL JS VARS -->
  <script>
    const BASE_URL = "<?= BASE_URL ?>";
  </script>
</head>