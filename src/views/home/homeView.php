<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body class="bg-gray-50 dark:bg-gray-900" id="top">

  <?php include_once __DIR__ . '/../../../includes/navbar.php'; ?>

  <main class="content-wrapper">
    <?php
    require_once __DIR__ . '/../../../config/config.php';
    require_once __DIR__ . '/../../../utils/slugify.php';

    // =========================
    // SEO helpers (HOME)
    // =========================
    $featuredRentas = [];
    if (!empty($rentasPorCategoria) && is_array($rentasPorCategoria)) {
      foreach ($rentasPorCategoria as $catName => $rentasList) {
        if (empty($rentasList) || !is_array($rentasList)) continue;
        foreach ($rentasList as $r) {
          if (!is_array($r)) continue;
          $id = $r['rental_id'] ?? null;
          if (!$id) continue;
          $featuredRentas[$id] = $r; // evita duplicados
        }
      }
    }
    $featuredRentas = array_slice(array_values($featuredRentas), 0, 8);

    $popularDestinations = [
      ['name' => 'La Habana',  'url' => BASE_URL . 'rents/provincias/' . slugify('La Habana')],
      ['name' => 'Varadero',   'url' => BASE_URL . 'rents/municipios/' . slugify('Varadero')],
      ['name' => 'Trinidad',   'url' => BASE_URL . 'rents/municipios/' . slugify('Trinidad')],
      ['name' => 'Viñales',    'url' => BASE_URL . 'rents/municipios/' . slugify('Viñales')],
      ['name' => 'Cienfuegos', 'url' => BASE_URL . 'rents/provincias/' . slugify('Cienfuegos')],
    ];

    $popularCategories = [
      ['name' => 'Casas de lujo', 'slug' => slugify('Casas de lujo')],
      ['name' => 'Casas en la playa', 'slug' => slugify('Casas en la playa')],
      ['name' => 'Largas y cortas estancias', 'slug' => slugify('Casas y Apartamentos por largas y cortas estancias')],
      ['name' => 'Alojamientos vacacionales', 'slug' => slugify('Casas y Alojamientos vacacionales')],
    ];
    ?>

    <!-- HERO SECTION (SEO + UX) -->
    <section
      class="relative overflow-hidden pt-20 pb-16 md:pt-28 md:pb-20 lg:pt-32 lg:pb-24 bg-gradient-to-br from-gray-50 via-white to-blue-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900"
      itemscope
      itemtype="https://schema.org/WPHeader"
      aria-label="Casas particulares en alquiler en Cuba">

      <!-- Decor -->
      <div class="pointer-events-none absolute -top-40 -right-40 h-80 w-80 rounded-full bg-cyan-100/30 dark:bg-cyan-900/20 blur-3xl"></div>
      <div class="pointer-events-none absolute top-1/3 -left-40 h-64 w-64 rounded-full bg-blue-100/30 dark:bg-blue-900/20 blur-3xl"></div>
      <div class="pointer-events-none absolute bottom-1/4 right-1/3 h-40 w-40 rounded-full bg-cyan-200/20 dark:bg-cyan-800/10 blur-3xl"></div>

      <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid items-center gap-8 lg:grid-cols-2 lg:gap-12 xl:gap-16">

          <!-- Text -->
          <div class="text-center lg:text-left">
            <div class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 px-4 py-2 mb-6">
              <span class="text-sm font-semibold text-cyan-700 dark:text-cyan-300">🏡 Hospedaje auténtico en Cuba</span>
            </div>

            <!-- ✅ H1 con keyword principal -->
            <h1
              class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl lg:text-6xl xl:text-7xl"
              itemprop="headline">
              <span class="block">Casas particulares</span>
              <span class="block bg-gradient-to-r from-cyan-600 via-blue-600 to-cyan-600 dark:from-cyan-400 dark:via-blue-400 dark:to-cyan-400 bg-clip-text text-transparent pb-2 animate-gradient bg-[length:200%_auto]">
                de alquiler en Cuba
              </span>
            </h1>

            <!-- ✅ Intro con intención transaccional + semántica -->
            <p
              class="mx-auto mt-6 max-w-2xl text-lg leading-relaxed text-gray-600 dark:text-gray-300 lg:mx-0 lg:text-xl"
              itemprop="description">
              Encuentra <strong class="text-gray-900 dark:text-white">casas particulares, apartamentos y villas</strong> para hospedarte en Cuba.
              Explora por destino (La Habana, Varadero, Trinidad y más), compara fotos y servicios, y
              <strong class="text-gray-900 dark:text-white">reserva por WhatsApp</strong>.
            </p>

            <!-- Stats (evita claims no verificables) -->
            <div class="mt-8 flex flex-wrap justify-center gap-6 lg:justify-start">
              <div class="text-center">
                <div class="text-2xl font-bold text-cyan-700 dark:text-cyan-400">250+</div>
                <div class="text-sm text-gray-500 dark:text-gray-400">Propiedades publicadas</div>
              </div>

            </div>

            <!-- Search -->
            <div class="mt-10">
              <?php include_once __DIR__ . '/searchHome.php'; ?>
            </div>

            <!-- ✅ Chips con anchor text útil -->
            <div class="mt-8">
              <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                📍 Buscar casas particulares en:
              </p>
              <div class="mt-3 flex flex-wrap justify-center gap-2 lg:justify-start">
                <?php foreach ($popularDestinations as $d): ?>
                  <a href="<?= htmlspecialchars($d['url'], ENT_QUOTES, 'UTF-8') ?>"
                    class="inline-flex items-center rounded-full bg-white dark:bg-gray-800 px-4 py-2.5 text-sm font-medium text-gray-700 dark:text-gray-200 shadow-sm ring-1 ring-gray-200 dark:ring-gray-700 hover:bg-cyan-50 dark:hover:bg-gray-700 hover:ring-cyan-300 dark:hover:ring-cyan-500 hover:text-cyan-700 dark:hover:text-cyan-300 transition-all duration-200 no-underline">
                    Casas en <?= htmlspecialchars($d['name'], ENT_QUOTES, 'UTF-8') ?>
                  </a>
                <?php endforeach; ?>
                <a href="<?= BASE_URL ?>rents"
                  class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-600 to-blue-600 px-4 py-2.5 text-sm font-semibold text-white shadow-lg hover:from-cyan-700 hover:to-blue-700 transition-all duration-200 no-underline">
                  Ver catálogo →
                </a>
              </div>
            </div>
          </div>

          <!-- Images -->
          <div class="relative mt-10 lg:mt-0">
            <div class="relative overflow-hidden rounded-3xl shadow-2xl dark:shadow-gray-900/50 transform hover:scale-[1.02] transition-transform duration-500">
              <img
                src="<?= BASE_URL ?>assets/img/hero3.webp"
                alt="Casas particulares en Cuba: alojamiento con piscina y jardín"
                loading="eager"
                class="h-[380px] w-full object-cover sm:h-[420px] lg:h-[480px] xl:h-[520px]">
              <div class="absolute inset-0 bg-gradient-to-t from-black/30 via-transparent to-transparent rounded-3xl"></div>
            </div>

            <div class="hidden lg:block absolute -bottom-6 -right-6 z-10 w-64 sm:w-72 lg:-bottom-8 lg:-right-8 xl:-bottom-10 xl:-right-10">
              <div class="relative overflow-hidden rounded-2xl shadow-xl dark:shadow-gray-900/50 transform hover:-translate-y-2 transition-all duration-300">
                <img
                  src="<?= BASE_URL ?>assets/img/hero2.webp"
                  alt="Interior de casa particular en Cuba con sala cómoda"
                  loading="eager"
                  class="h-48 w-full object-cover lg:h-52 xl:h-56">
                <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </section>

    <!-- ✅ BLOQUE EDITORIAL (clave para Google) -->
    <section class="py-12 bg-gradient-to-tl dark:from-gray-900 dark:via-gray-900 dark:to-gray-800" aria-label="Guía para alquilar casas particulares en Cuba">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid gap-8 lg:grid-cols-12 lg:gap-12">
          <div class="lg:col-span-8">
            <h2 class="text-2xl md:text-3xl font-bold text-gray-900 dark:text-white">
              Cómo elegir casas particulares para hospedarse en Cuba
            </h2>
            <p class="mt-4 text-gray-700 dark:text-gray-300 leading-relaxed">
              Las <strong class="text-gray-900 dark:text-white">casas particulares en alquiler en Cuba</strong> son una de las opciones más buscadas
              para quienes desean unas vacaciones inolvidables en el Caribe. La mejor elección para hospedarse depende del destino,
              el número de personas y las comodidades que necesitas.
            </p>
            <p class="mt-4 text-gray-700 dark:text-gray-300 leading-relaxed">
              Empieza explorando por zona: por ejemplo, si buscas cultura y vida urbana, mira
              <a class="text-cyan-700 dark:text-cyan-300 hover:underline" href="<?= BASE_URL ?>rents/provincias/<?= slugify('La Habana') ?>">casas particulares en La Habana</a>.
              Para ver arena y playas hermosas, revisa
              <a class="text-cyan-700 dark:text-cyan-300 hover:underline" href="<?= BASE_URL ?>rents/municipios/<?= slugify('Varadero') ?>">casas en Varadero</a>.
              Si prefieres un destino colonial, visita
              <a class="text-cyan-700 dark:text-cyan-300 hover:underline" href="<?= BASE_URL ?>rents/municipios/<?= slugify('Trinidad') ?>">Trinidad</a>.
            </p>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
              <div class="rounded-2xl bg-gray-50 dark:bg-gray-800 p-5">
                <h3 class="font-semibold text-gray-900 dark:text-white">Elige destino y fechas</h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                  Define tu ruta y revisa disponibilidad. En temporada alta conviene reservar con antelación.
                </p>
              </div>
              <div class="rounded-2xl bg-gray-50 dark:bg-gray-800 p-5">
                <h3 class="font-semibold text-gray-900 dark:text-white">Filtra por capacidad y servicios</h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                  Asegúrate de que la propiedad encaje con tu grupo y tus necesidades.
                </p>
              </div>
              <div class="rounded-2xl bg-gray-50 dark:bg-gray-800 p-5">
                <h3 class="font-semibold text-gray-900 dark:text-white">Compara opciones</h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                  Revisa fotos, descripción y ubicación antes de tomar una decisión.
                </p>
              </div>
              <div class="rounded-2xl bg-gray-50 dark:bg-gray-800 p-5">
                <h3 class="font-semibold text-gray-900 dark:text-white">Reserva por WhatsApp</h3>
                <p class="mt-2 text-sm text-gray-700 dark:text-gray-300">
                  Confirma condiciones, hora de llegada y cualquier detalle importante.
                </p>
              </div>
            </div>

            <div class="mt-7 flex flex-col sm:flex-row gap-3">
              <a href="<?= BASE_URL ?>rents"
                class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-3 text-sm font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 hover:shadow-xl">
                Explorar casas particulares
              </a>
              <a href="#destinos"
                class="inline-flex items-center justify-center rounded-xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-6 py-3 text-sm font-semibold text-gray-700 dark:text-gray-200 hover:border-cyan-400 hover:text-cyan-700 dark:hover:text-cyan-300 transition-colors">
                Ver destinos populares
              </a>
            </div>
          </div>

          <!-- Sidebar: categorías -->
          <aside class="lg:col-span-4">
            <div class="rounded-3xl bg-gray-50 dark:bg-gray-800 p-6 ring-1 ring-gray-200/60 dark:ring-gray-700/60">
              <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                Explora por categoría
              </h3>
              <ul class="mt-4 space-y-3">
                <?php foreach ($popularCategories as $c): ?>
                  <li>
                    <a href="<?= BASE_URL ?>rents/<?= htmlspecialchars($c['slug'], ENT_QUOTES, 'UTF-8') ?>"
                      class="group flex items-center justify-between rounded-2xl border border-gray-200 dark:border-gray-700 bg-white dark:bg-gray-900 px-4 py-3 no-underline hover:border-cyan-400 transition-colors">
                      <span class="text-sm font-medium text-gray-800 dark:text-gray-200">
                        <?= htmlspecialchars($c['name'], ENT_QUOTES, 'UTF-8') ?>
                      </span>
                      <span class="text-sm text-gray-500 dark:text-gray-400 group-hover:text-cyan-600 dark:group-hover:text-cyan-300">
                        Ver →
                      </span>
                    </a>
                  </li>
                <?php endforeach; ?>
              </ul>

              <div class="mt-6 text-sm text-gray-700 dark:text-gray-300">
                <p class="font-semibold text-gray-900 dark:text-white">Nota:</p>
                <p class="mt-1">
                  Las casas se clasifican en categorías para facilitar la búsqueda al usuario y que pueda encontrar lo que necesita mas facilmente.
                </p>
              </div>
            </div>
          </aside>
        </div>
      </div>
    </section>

    <!-- PROPIEDADES DESTACADAS (mejor anclaje semántico) -->
    <?php if (!empty($featuredRentas)): ?>
      <section class="py-16 md:py-20 bg-gray-50 dark:bg-gray-900/50" aria-label="Casas particulares destacadas en Cuba">
        <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
          <div class="text-center mb-12">
            <span class="inline-block rounded-full bg-gradient-to-r from-cyan-100 to-blue-100 dark:from-cyan-900/30 dark:to-blue-900/30 px-4 py-1.5 text-sm font-semibold text-cyan-700 dark:text-cyan-300 mb-4">
              🏆 Selección destacada
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
              Casas particulares y alojamientos <span class="text-cyan-600 dark:text-cyan-400">destacados</span> en Cuba
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
              Empieza por estas opciones y luego ajusta con filtros en el catálogo.
            </p>
          </div>

          <div class="mt-10 grid gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
            <?php foreach ($featuredRentas as $renta): ?>
              <?php
              $images = !empty($renta['images']) ? explode(',', $renta['images']) : [];
              $cardImage = !empty($images[0]) ? (BASE_URL . 'uploads/' . $images[0]) : (BASE_URL . 'assets/img/default-img.png');

              $rentalId    = $renta['rental_id'] ?? '';
              $rentalTitle = htmlspecialchars($renta['rental_title'] ?? '', ENT_QUOTES, 'UTF-8');
              $provincia   = htmlspecialchars($renta['rental_provincia'] ?? '', ENT_QUOTES, 'UTF-8');
              $municipio   = htmlspecialchars($renta['rental_municipio'] ?? '', ENT_QUOTES, 'UTF-8');

              // ✅ Evita bug: soporta ambos nombres de campo
              $capacidadVal = $renta['rental_capacity'] ?? $renta['rental_capacidad'] ?? null;

              $slug = slugify($rentalTitle);
              $url  = rtrim(BASE_URL, '/') . "/rents/" . $slug . "-" . $rentalId;
              ?>
              <article class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-lg hover:shadow-2xl dark:shadow-gray-900/30 overflow-hidden transition-all duration-300 transform hover:-translate-y-1">
                <div class="absolute top-4 left-4 z-10">
                  <span class="rounded-full bg-gradient-to-r from-amber-500 to-orange-500 px-3 py-1 text-xs font-semibold text-white">
                    Destacada
                  </span>
                </div>

                <a href="<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>" class="block no-underline">
                  <div class="relative h-56 overflow-hidden">
                    <img
                      src="<?= htmlspecialchars($cardImage, ENT_QUOTES, 'UTF-8') ?>"
                      alt="<?= $rentalTitle ?>"
                      loading="lazy"
                      class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/40 via-transparent to-transparent"></div>
                  </div>

                  <div class="p-5">
                    <div class="flex items-center gap-2 mb-2">
                      <svg class="w-4 h-4 text-cyan-600 dark:text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                      </svg>
                      <span class="text-sm text-gray-600 dark:text-gray-400">
                        <?= $provincia ?><?= ($provincia && $municipio) ? ', ' : '' ?><?= $municipio ?>
                      </span>
                    </div>

                    <h3 class="text-sm font-bold text-gray-900 dark:text-white line-clamp-2 group-hover:text-cyan-700 dark:group-hover:text-cyan-300 transition-colors">
                      <?= $rentalTitle ?>
                    </h3>

                    <div class="mt-4 flex items-center justify-between">
                      <div class="flex items-center gap-2">
                        <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197m13.67 3.667a8.25 8.25 0 00-13.34 0" />
                        </svg>
                        <span class="text-sm font-medium text-gray-700 dark:text-gray-300">
                          <?= $capacidadVal ? ((int)$capacidadVal . ' personas') : 'Capacidad: consultar' ?>
                        </span>
                      </div>

                      <span class="text-sm font-semibold text-cyan-700 dark:text-cyan-300 group-hover:translate-x-1 transition-transform">
                        Ver detalles →
                      </span>
                    </div>
                  </div>
                </a>
              </article>
            <?php endforeach; ?>
          </div>

          <div class="mt-12 text-center">
            <a href="<?= BASE_URL ?>rents"
              class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 px-8 py-4 text-base font-semibold text-white shadow-lg hover:from-cyan-700 hover:to-blue-700 hover:shadow-xl transform hover:-translate-y-0.5 transition-all duration-200">
              Explorar todas las propiedades
              <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
              </svg>
            </a>
          </div>

          <!-- JSON-LD ItemList -->
          <script type="application/ld+json">
            {
              "@context": "https://schema.org",
              "@type": "ItemList",
              "name": "Casas particulares destacadas - CuVaRents",
              "itemListElement": [
                <?php foreach ($featuredRentas as $i => $renta): ?>
                  <?php
                  $images = !empty($renta['images']) ? explode(',', $renta['images']) : [];
                  $img = !empty($images[0]) ? (BASE_URL . 'uploads/' . $images[0]) : (BASE_URL . 'assets/img/default-img.png');

                  $rentalId    = $renta['rental_id'] ?? '';
                  $titleRaw    = $renta['rental_title'] ?? '';
                  $rentalTitle = htmlspecialchars($titleRaw, ENT_QUOTES, 'UTF-8');

                  $slug = slugify($titleRaw);
                  $url  = rtrim(BASE_URL, '/') . "/rents/" . $slug . "-" . $rentalId;
                  ?> {
                    "@type": "ListItem",
                    "position": <?= (int)($i + 1) ?>,
                    "url": "<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>",
                    "item": {
                      "@type": "Accommodation",
                      "name": "<?= $rentalTitle ?>",
                      "url": "<?= htmlspecialchars($url, ENT_QUOTES, 'UTF-8') ?>",
                      "image": "<?= htmlspecialchars($img, ENT_QUOTES, 'UTF-8') ?>"
                    }
                  }
                  <?= ($i < count($featuredRentas) - 1) ? ',' : '' ?>
                <?php endforeach; ?>
              ]
            }
          </script>
        </div>
      </section>
    <?php endif; ?>

    <!-- GUÍA DE RESERVA (ya estaba bien, se mantiene) -->
    <section class="py-16 md:py-20 bg-white dark:bg-gray-900" aria-label="Cómo reservar casas particulares en Cuba">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <span class="inline-block rounded-full bg-gradient-to-r from-green-100 to-emerald-100 dark:from-green-900/30 dark:to-emerald-900/30 px-4 py-1.5 text-sm font-semibold text-green-700 dark:text-green-300 mb-4">
            📋 Guía rápida
          </span>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
            Reserva tu alojamiento en <span class="text-green-600 dark:text-green-400">4 pasos</span>
          </h2>
          <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            Sigue estos pasos para encontrar y reservar tu casa particular ideal en Cuba.
          </p>
        </div>

        <div class="mt-12 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
          <div class="relative bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 text-center group hover:bg-white dark:hover:bg-gray-700 transition-all duration-300">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 text-white text-xl font-bold mb-4">1</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Elige destino</h3>
            <p class="text-gray-600 dark:text-gray-300">Explora por provincia o municipio y decide tu ubicación.</p>
            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 hidden lg:block">
              <svg class="w-6 h-6 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
          </div>

          <div class="relative bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 text-center group hover:bg-white dark:hover:bg-gray-700 transition-all duration-300">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 text-white text-xl font-bold mb-4">2</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Filtra y compara</h3>
            <p class="text-gray-600 dark:text-gray-300">Filtra por precio, capacidad y servicios para elegir mejor.</p>
            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 hidden lg:block">
              <svg class="w-6 h-6 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
          </div>

          <div class="relative bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 text-center group hover:bg-white dark:hover:bg-gray-700 transition-all duration-300">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-indigo-500 to-purple-500 text-white text-xl font-bold mb-4">3</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Contacta directo</h3>
            <p class="text-gray-600 dark:text-gray-300">Confirma disponibilidad y resuelve dudas por WhatsApp.</p>
            <div class="absolute -right-3 top-1/2 transform -translate-y-1/2 hidden lg:block">
              <svg class="w-6 h-6 text-gray-300 dark:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
              </svg>
            </div>
          </div>

          <div class="bg-gray-50 dark:bg-gray-800 rounded-2xl p-6 text-center group hover:bg-white dark:hover:bg-gray-700 transition-all duration-300">
            <div class="inline-flex items-center justify-center w-14 h-14 rounded-full bg-gradient-to-r from-purple-500 to-pink-500 text-white text-xl font-bold mb-4">4</div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Disfruta tu viaje</h3>
            <p class="text-gray-600 dark:text-gray-300">Llega con todo confirmado y vive Cuba a tu ritmo.</p>
          </div>
        </div>
      </div>
    </section>

    <!-- CATEGORÍAS DINÁMICAS -->
    <?php include_once __DIR__ . '/category.php'; ?>

    <!-- DESTINOS -->
    <section id="destinos" class="py-16 md:py-20 bg-gray-50 dark:bg-gray-900/50">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <?php include_once __DIR__ . '/destinos.php'; ?>
      </div>
    </section>

    <!-- BENEFICIOS (sin promesas difíciles de probar) -->
    <section class="py-16 md:py-20 bg-white dark:bg-gray-900">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
          <div class="flex flex-row justify-center items-center">
            <span class="flex flex-row items-center rounded-full bg-gradient-to-r from-amber-100 to-orange-100 dark:from-amber-900/30 dark:to-orange-900/30 px-4 py-1.5 text-sm font-semibold text-amber-700 dark:text-amber-300 mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
              </svg>
              Beneficios
            </span>
          </div>
          <h2 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
            ¿Por qué elegir <span class="text-amber-600 dark:text-amber-400">CuVaRents</span>?
          </h2>
          <p class="mt-4 text-lg text-gray-600 dark:text-gray-300 max-w-2xl mx-auto">
            Herramientas claras para buscar, comparar y reservar tu alojamiento en Cuba.
          </p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
          <div class="relative bg-gradient-to-br from-cyan-50 to-blue-50 dark:from-cyan-900/20 dark:to-blue-900/20 rounded-2xl px-6 py-12">
            <div class="absolute -top-6 left-8 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-900/20 to-blue-900/20 dark:from-cyan-800/50 dark:to-blue-900/50 shadow-lg">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Búsqueda por filtros</h3>
            <p class="text-gray-600 dark:text-gray-300">
              Encuentra casas particulares, apartamentos y villas filtrando por destino, capacidad y servicios.
            </p>
          </div>

          <div class=" relative bg-gradient-to-br from-green-50 to-emerald-50 dark:from-green-900/20 dark:to-emerald-900/20 rounded-2xl px-6 py-12">
            <div class="absolute -top-6 left-8 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-800/20 to-blue-900/20 dark:from-cyan-800/50 dark:to-blue-900/50 shadow-lg">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Contacto por WhatsApp</h3>
            <p class="text-gray-600 dark:text-gray-300">
              Confirma disponibilidad y detalles directamente desde la ficha de cada propiedad.
            </p>
          </div>

          <div class="relative bg-gradient-to-br from-purple-50 to-pink-50 dark:from-purple-900/20 dark:to-blue-900/10 rounded-2xl px-6 py-12">
            <div class="absolute -top-6 left-8 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-800/20 to-blue-900/20 dark:from-cyan-800/50 dark:to-blue-900/50 shadow-lg">
              <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
              </svg>
            </div>
            <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-3">Cobertura en Cuba</h3>
            <p class="text-gray-600 dark:text-gray-300">
              Explora destinos populares y descubre opciones de hospedaje en distintas zonas del país.
            </p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ -->
    <?php include_once __DIR__ . '/preguntas.php'; ?>


  </main>

  <script src="<?= BASE_URL ?>assets/js/ui-accordion.js"></script>

  <?php include_once __DIR__ . '/../../../includes/footer.php'; ?>

</body>

</html>