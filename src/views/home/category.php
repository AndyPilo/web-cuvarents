<!-- CATEGORÍAS DINÁMICAS - DISEÑO MODERNO -->
<section class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8 lg:py-16">
  <!-- Header principal de la sección -->
  <div class="text-center mb-12 lg:mb-16">
    <div class="inline-flex items-center justify-center mb-4">
      <span class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/30 dark:to-blue-900/30 px-4 py-2">
        <span class="mr-2 h-2 w-2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500"></span>
        <span class="text-sm font-medium text-cyan-800 dark:text-cyan-300">Encuentra por categoría</span>
      </span>
    </div>

    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl lg:text-5xl">
      <span class="block">Explora Casas particulares de alquiler en Cuba</span>
      <span class="block bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 bg-clip-text text-transparent pb-2">
        por categoría
      </span>
    </h2>

    <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
      Descubre nuestra selección de casas y apartamentos particulares de alquiler organizados por tipo de propiedad
    </p>
  </div>

  <?php foreach ($rentasPorCategoria as $categoria => $rentas): ?>
    <?php if (!empty($rentas)): ?>
      <div class="mb-12 lg:mb-16 last:mb-0">

        <!-- Header de categoría mejorado -->
        <div class="flex items-center justify-between mb-6 lg:mb-8">
          <div class="flex items-center gap-4">
            <div>
              <h3 class="text-xl font-bold text-gray-900 dark:text-white md:text-2xl">
                <?= htmlspecialchars($categoria) ?>
              </h3>
              <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                <?= count($rentas) ?> propiedades disponibles
              </p>
            </div>
          </div>

          <a
            href="<?= BASE_URL ?>rents/<?= slugify($categoria) ?>"
            class="group inline-flex items-center gap-2 rounded-full border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-5 py-2.5
                   text-sm font-semibold text-gray-700 dark:text-gray-300 no-underline transition-all
                   hover:border-cyan-500 dark:hover:border-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/30 hover:text-cyan-700 dark:hover:text-cyan-400 hover:shadow-sm">
            <span>Ver todo</span>
            <svg class="h-4 w-4 transition-transform group-hover:translate-x-1"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </a>
        </div>

        <!-- Carrusel / Grid -->
        <div class="relative min-w-0">
          <!-- En móvil y md: carrusel (scroll horizontal). En lg+: grid -->
          <div
            class="min-w-0 w-full flex gap-4 overflow-x-auto pb-4 snap-x snap-mandatory scroll-smooth no-scrollbar
                   lg:grid lg:grid-cols-3 xl:grid-cols-4 lg:gap-6 lg:overflow-visible"
            style="touch-action: pan-x;">
            <?php foreach (array_slice($rentas, 0, 8) as $renta): ?>
              <?php
              $images     = !empty($renta['images']) ? explode(',', $renta['images']) : [];
              $cardImage  = !empty($images[0]) ? BASE_URL . 'uploads/' . $images[0] : BASE_URL . 'assets/img/default-img.png';

              $rentalId    = $renta['rental_id'];
              $rentalTitle = htmlspecialchars($renta['rental_title'], ENT_QUOTES, 'UTF-8');
              $rentalHab   = htmlspecialchars($renta['rental_rooms'] ?? '', ENT_QUOTES, 'UTF-8');
              $provincia   = htmlspecialchars($renta['rental_provincia'] ?? '', ENT_QUOTES, 'UTF-8');
              $municipio   = htmlspecialchars($renta['rental_municipio'] ?? '', ENT_QUOTES, 'UTF-8');
              $isPromoted  = $renta['is_promoted'] ?? 0;
              $capacity    = $renta['rental_capacity'] ?? 0;

              $rentalPriceRaw  = $renta['rental_price'] ?? '';
              $rentalPriceType = htmlspecialchars($renta['rental_price_type'] ?? '', ENT_QUOTES, 'UTF-8');

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

              $servicesData = $renta['service_data'] ?? null;
              $servicesOld  = $renta['service_icons'] ?? null;
              $servicesArr  = $renta['services'] ?? [];
              ?>

              <article
                class="group relative flex flex-col shrink-0 w-[280px] snap-start rounded-2xl bg-white dark:bg-gray-800
                       shadow-md dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50 transition-all duration-300
                       hover:-translate-y-1 hover:shadow-xl dark:hover:shadow-gray-900 hover:ring-gray-300/80 dark:hover:ring-gray-600/80
                       lg:w-auto lg:shrink"
                itemscope
                itemtype="https://schema.org/Accommodation">

                <!-- Overlay: TODA la card es clickeable (sin romper el swipe del carrusel) -->
                <a href="<?= $url ?>"
                  class="absolute inset-0 z-50 touch-pan-x"
                  style="touch-action: pan-x;"
                  aria-label="<?= htmlspecialchars($rentalTitle, ENT_QUOTES, 'UTF-8') ?>">
                </a>

                <!-- Imagen -->
                <div class="relative block overflow-hidden rounded-t-2xl aspect-square z-20">
                  <div class="absolute inset-0 bg-gradient-to-t from-black/20 via-transparent to-transparent z-10"></div>

                  <img src="<?= $cardImage ?>" alt="<?= $rentalTitle ?>" loading="lazy" itemprop="image"
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
                        d="M15 11a3 3 0 11-6 0 3 3 0 0 1 6 0z" />
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

                  <?php if (!empty($servicesData) || !empty($servicesOld) || !empty($servicesArr)): ?>
                    <div class="flex items-center gap-2 text-gray-500 dark:text-gray-400 mb-3" aria-hidden="false">
                      <?php
                      if (!empty($servicesData)) {
                        $pairs = array_filter(explode('||', $servicesData));
                        $pairs = array_slice($pairs, 0, 6);
                        foreach ($pairs as $p) {
                          $parts = explode('::', $p, 2);
                          $icon = trim($parts[0] ?? '');
                          $name = htmlspecialchars(trim($parts[1] ?? ''), ENT_QUOTES, 'UTF-8');
                          if ($icon !== '') echo '<span class="inline-flex items-center" title="' . $name . '">' . trim($icon) . '</span>';
                        }
                      } elseif (!empty($servicesArr)) {
                        $show = array_slice($servicesArr, 0, 6);
                        foreach ($show as $s) {
                          $icon = $s['icon'] ?? '';
                          $name = htmlspecialchars($s['name'] ?? '', ENT_QUOTES, 'UTF-8');
                          if ($icon !== '') echo '<span class="inline-flex items-center" title="' . $name . '">' . $icon . '</span>';
                        }
                      } else {
                        $icons = array_filter(explode('|', $servicesOld));
                        $icons = array_slice($icons, 0, 6);
                        foreach ($icons as $ic) echo trim($ic);
                      }
                      ?>
                    </div>
                  <?php endif; ?>
                </div>
              </article>
            <?php endforeach; ?>
          </div>
        </div>

        <!-- Ver más propiedades (si hay más de 8) -->
        <?php if (count($rentas) > 8): ?>
          <div class="mt-8 text-center">
            <a
              href="<?= BASE_URL ?>rents/<?= slugify($categoria) ?>"
              class="inline-flex items-center justify-center rounded-full border border-gray-300 dark:border-gray-700
                     bg-white dark:bg-gray-800 px-6 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 no-underline
                     hover:border-gray-400 dark:hover:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-sm transition-all">
              Ver <?= count($rentas) - 8 ?> propiedades más de <?= htmlspecialchars($categoria) ?>
              <svg class="ml-2 h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
              </svg>
            </a>
          </div>
        <?php endif; ?>

      </div>
    <?php endif; ?>
  <?php endforeach; ?>
</section>