<?php

// Aquí NO se inicia sesión, ya está gestionado en bootstrap.php
$basePath = BASE_PATH;

// Sanitizar valores SEO (para evitar warnings de null)
foreach ($seo as $key => $value) {
  if (is_array($value)) continue;
  $seo[$key] = $value ?? '';
}
?>
<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>

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

  <!-- SEO PRINCIPAL -->
  <title><?= htmlspecialchars($seo['title']); ?></title>
  <meta name="description" content="<?= htmlspecialchars($seo['description']); ?>">
  <meta name="keywords" content="<?= htmlspecialchars($seo['keywords']); ?>">
  <meta name="robots" content="<?= htmlspecialchars($seo['robots']); ?>">
  <meta name="author" content="CuVaRents">
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
          "name": "Casas particulares de alquiler en Cuba | CuVaRents",
          "description": "Casas particulares, apartamentos, hostales y villas en alquiler en toda Cuba. Propiedades en La Habana, Varadero, Trinidad y más. Reserva por WhatsApp.",
          "publisher": {
            "@id": "https://cuvarents.com/#organization"
          },
          "potentialAction": {
            "@type": "SearchAction",
            "target": {
              "@type": "EntryPoint",
              "urlTemplate": "https://cuvarents.com/rents?search={search_term_string}"
            },
            "query-input": "required name=search_term_string"
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
            "https://www.facebook.com/people/Agencia-Cuvarents/61560542866042/?mibextid=ZbWKwL",
            "https://www.instagram.com/cuvarents"
          ],
          "contactPoint": [{
            "@type": "ContactPoint",
            "telephone": "+5353868634",
            "contactType": "customer service",
            "availableLanguage": ["es", "en"],
            "areaServed": "CU"
          }]
        },
        {
          "@type": "WebPage",
          "@id": "https://cuvarents.com/#webpage",
          "url": "https://cuvarents.com/",
          "name": "Casas particulares de alquiler en Cuba | CuVaRents",
          "description": "Casas particulares, apartamentos, hostales y villas en alquiler en toda Cuba. Propiedades en La Habana, Varadero, Trinidad y más. Reserva por WhatsApp.",
          "isPartOf": {
            "@id": "https://cuvarents.com/#website"
          },
          "inLanguage": "es"
        },
        {
          "@type": "BreadcrumbList",
          "@id": "https://cuvarents.com/#breadcrumb",
          "itemListElement": [{
            "@type": "ListItem",
            "position": 1,
            "name": "Inicio",
            "item": "https://cuvarents.com/"
          }]
        }
      ]
    }
  </script>


  <!-- GLOBAL JS VARS -->
  <script>
    const BASE_URL = "<?= BASE_URL ?>";
  </script>
</head>