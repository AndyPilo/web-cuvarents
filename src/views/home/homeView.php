<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body class="bg-gray-50 dark:bg-gray-900">

  <?php include_once __DIR__ . '/../../../includes/navbar.php'; ?>

  <main class="content-wrapper">
    <?php
    require_once __DIR__ . '/../../../config/config.php';
    require_once __DIR__ . '/../../../utils/slugify.php';
    ?>

    <!-- HERO SECTION -->
    <section
      class="relative overflow-hidden pt-24 pb-16 md:pt-28 md:pb-20 lg:pt-32 lg:pb-24"
      itemscope
      itemtype="https://schema.org/WPHeader">
      <!-- Elementos decorativos -->
      <div class="pointer-events-none absolute -top-20 -right-20 h-64 w-64 rounded-full bg-cyan-100/40 dark:bg-blue-900/30 blur-3xl"></div>
      <div class="pointer-events-none absolute top-1/3 -left-20 h-48 w-48 rounded-full bg-blue-100/30 dark:bg-blue-900/30 blur-3xl"></div>

      <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-12 lg:grid-cols-2 lg:gap-16">

          <!-- Columna de texto -->
          <div class="text-center lg:text-left">
            <h1
              class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl"
              itemprop="headline">
              <span class="block">Casas particulares</span>
              <span class="block bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 bg-clip-text text-transparent pb-2">
                de alquiler en Cuba
              </span>
            </h1>

            <p
              class="mx-auto mt-6 max-w-2xl text-lg text-gray-600 dark:text-gray-300 lg:mx-0"
              itemprop="description">
              Descubre más de <span class="font-semibold text-cyan-700 dark:text-cyan-400">250 propiedades verificadas</span>
              en toda Cuba. Casas auténticas con fotos reales, apartamentos modernos y villas de lujo.
              Encuentra el alojamiento perfecto para tu estancia y disfruta de una
              reserva segura.
            </p>

            <!-- Buscador principal -->
            <div class="mt-8">
              <?php include_once __DIR__ . '/searchHome.php'; ?>
            </div>

            <!-- Estadísticas rápidas -->
            <div class="mt-10 grid grid-cols-1 gap-4 ">
              <div class="text-center lg:text-left">
                <div class="text-2xl font-bold text-cyan-700 dark:text-cyan-400 sm:text-3xl">250+</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Propiedades</div>
              </div>
            </div>
          </div>

          <!-- Columna de imágenes -->
          <div class="relative">
            <!-- Imagen principal -->
            <div class="relative overflow-hidden rounded-3xl shadow-2xl dark:shadow-gray-900/50">
              <img
                src="<?= BASE_URL ?>assets/img/hero3.webp"
                alt="Vista principal de casa en alquiler en Cuba con piscina y jardín tropical"
                loading="eager"
                class="h-[380px] w-full object-cover transition-transform duration-700 hover:scale-105 sm:h-[420px] lg:h-[480px]">
              <div class="pointer-events-none absolute inset-0 rounded-3xl bg-gradient-to-t from-black/10 to-transparent"></div>
            </div>

            <!-- Imagen secundaria flotante -->
            <div class="hidden absolute -bottom-6 -right-6 z-10 w-64 sm:w-72 lg:block lg:-bottom-10 lg:-right-8">
              <div class="overflow-hidden rounded-2xl shadow-xl dark:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-1 hover:shadow-2xl dark:hover:shadow-gray-900">
                <img
                  src="<?= BASE_URL ?>assets/img/hero2.webp"
                  alt="Interior de casa particular en Cuba con sala moderna y confortable"
                  loading="eager"
                  class="h-48 w-full object-cover">
              </div>
            </div>
          </div>

        </div>
    </section>

    <!-- CATEGORÍAS DINÁMICAS -->
    <?php include_once __DIR__ . '/category.php'; ?>

    <!-- SECCIÓN DESTINOS -->
    <section class="mx-auto max-w-[1320px] px-4 py-10">
      <?php include_once __DIR__ . '/destinos.php'; ?>
    </section>

    <!-- SECCIÓN PREGUNTAS -->
    <?php include_once __DIR__ . '/preguntas.php'; ?>

  </main>

  <script src="<?= BASE_URL ?>assets/js/ui-accordion.js"></script>

  <?php include_once __DIR__ . '/../../../includes/footer.php'; ?>

</body>

</html>