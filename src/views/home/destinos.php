<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-16">
  <!-- Header de la sección -->
  <div class="text-center mb-12 lg:mb-16">
    <div class="inline-flex items-center justify-center mb-4">
      <span class="inline-flex items-center rounded-full bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/30 dark:to-blue-900/30 px-4 py-2">
        <span class="mr-2 h-2 w-2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-500"></span>
        <span class="text-sm font-medium text-cyan-800 dark:text-cyan-300">Destinos populares</span>
      </span>
    </div>

    <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl lg:text-5xl">
      Casas particulares en los destinos más buscados de
      <span class="bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 bg-clip-text text-transparent">
        Cuba
      </span>
    </h2>

    <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
      Elige tu destino y encuentra la renta ideal para un viaje en familia o una escapada romántica
    </p>
  </div>

  <!-- Grid de destinos -->
  <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
    <?php
    $destinos = [
      [
        'nombre' => 'La Habana',
        'img' => BASE_URL . 'assets/img/habana.webp',
        'descripcion' => 'Rentas acogedoras para vivir La Habana con calma: paseos por La Habana Vieja, atardeceres en el Malecón y noches con música.',
        'tipo' => 'cultural',
        'icon' => '🏛️',
        'url' => BASE_URL . 'rents/provincias/' . slugify('La Habana'),
      ],
      [
        'nombre' => 'Varadero',
        'img' => BASE_URL . 'assets/img/varadero.webp',
        'descripcion' => 'Casas particulares cerca de la playa para descansar en pareja o en familia: arena blanca, agua clara y atardeceres inolvidables.',
        'tipo' => 'playa',
        'icon' => '🏖️',
        'url' => BASE_URL . 'rents/municipios/' . slugify('Varadero'),
      ],
      [
        'nombre' => 'Trinidad',
        'img' => BASE_URL . 'assets/img/trinidad.webp',
        'descripcion' => 'Hospédate en casas con encanto colonial y vive un destino perfecto para caminar sin prisa, compartir en familia y enamorarte del ambiente.',
        'tipo' => 'colonial',
        'icon' => '🏘️',
        'url' => BASE_URL . 'rents/municipios/' . slugify('Trinidad'),
      ],
      [
        'nombre' => 'Viñales',
        'img' => BASE_URL . 'assets/img/viniales.webp',
        'descripcion' => 'Rentas rodeadas de naturaleza para desconectar juntos: paisajes únicos, aire puro y planes tranquilos para grandes y pequeños.',
        'tipo' => 'rural',
        'icon' => '🌄',
        'url' => BASE_URL . 'rents/municipios/' . slugify('Viñales'),
      ],
      [
        'nombre' => 'Cienfuegos',
        'img' => BASE_URL . 'assets/img/cienfuegos.webp',
        'descripcion' => 'Un destino sereno para disfrutar en pareja o en familia: paseos junto al mar, arquitectura bonita y una energía súper relajada.',
        'tipo' => 'costero',
        'icon' => '⛵',
        'url' => BASE_URL . 'rents/provincias/' . slugify('Cienfuegos'),
      ],
    ];

    foreach ($destinos as $destino):
      // Asignar clase de color según tipo
      $colorClass = match ($destino['tipo']) {
        'playa' => 'from-cyan-500/20 to-blue-500/20 dark:from-cyan-600/30 dark:to-blue-600/30',
        'cultural' => 'from-amber-500/20 to-orange-500/20 dark:from-amber-600/30 dark:to-orange-600/30',
        'colonial' => 'from-emerald-500/20 to-green-500/20 dark:from-emerald-600/30 dark:to-green-600/30',
        'rural' => 'from-lime-500/20 to-emerald-500/20 dark:from-lime-600/30 dark:to-emerald-600/30',
        'musical' => 'from-purple-500/20 to-pink-500/20 dark:from-purple-600/30 dark:to-pink-600/30',
        'costero' => 'from-sky-500/20 to-cyan-500/20 dark:from-sky-600/30 dark:to-cyan-600/30',
        default => 'from-gray-500/20 to-gray-600/20 dark:from-gray-700/30 dark:to-gray-800/30'
      };
    ?>
      <a
        href="<?= htmlspecialchars($destino['url']) ?>"
        class="group relative block overflow-hidden rounded-2xl bg-white dark:bg-gray-800 shadow-lg dark:shadow-gray-900/50 ring-1 ring-gray-200/50 dark:ring-gray-700/50
               transition-all duration-500 hover:-translate-y-2 hover:shadow-2xl dark:hover:shadow-gray-900 hover:ring-gray-300/80 dark:hover:ring-gray-600/80 no-underline">

        <!-- Imagen con overlay -->
        <div class="relative h-64 overflow-hidden">
          <img
            src="<?= htmlspecialchars($destino['img']) ?>"
            alt="Casas particulares en <?= htmlspecialchars($destino['nombre']) ?>"
            loading="lazy"
            class="h-full w-full object-cover transition-transform duration-700" />

          <!-- Overlay gradiente -->
          <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent"></div>

          <!-- Badge tipo -->
          <div class="absolute top-4 left-4 z-10">
            <div class="flex items-center gap-2 rounded-full bg-white/90 dark:bg-gray-800/90 backdrop-blur-sm px-3 py-1.5">
              <span class="text-lg"><?= $destino['icon'] ?></span>
              <span class="text-xs font-medium text-gray-800 dark:text-gray-300 capitalize"><?= htmlspecialchars($destino['tipo']) ?></span>
            </div>
          </div>
        </div>

        <!-- Contenido -->
        <div class="p-6">
          <div class="mb-3">
            <h3 class="text-xl font-bold text-gray-900 dark:text-white group-hover:text-cyan-700 dark:group-hover:text-cyan-400 transition-colors">
              <?= htmlspecialchars($destino['nombre']) ?>
            </h3>
          </div>

          <!-- Descripción (SEO + atractiva, sin datos falsos) -->
          <div class="mt-3 rounded-xl bg-gray-50 dark:bg-gray-700 p-4">
            <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed">
              <?= htmlspecialchars($destino['descripcion']) ?>
            </p>
          </div>

          <!-- Botón -->
          <div class="mt-6 flex items-center justify-between">
            <span class="text-sm font-medium text-cyan-700 dark:text-cyan-400 group-hover:text-cyan-800 dark:group-hover:text-cyan-300 transition-colors">
              Ver casas particulares
            </span>
            <svg class="h-5 w-5 text-gray-400 dark:text-gray-500 transition-transform group-hover:translate-x-2 group-hover:text-cyan-600 dark:group-hover:text-cyan-400"
              fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
          </div>
        </div>

        <!-- Efecto hover overlay -->
        <div class="absolute inset-0 rounded-2xl bg-gradient-to-br <?= $colorClass ?>
                    opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none"></div>
      </a>
    <?php endforeach; ?>
  </div>

  <!-- CTA al final -->
  <div class="mt-12 text-center">
    <div class="inline-flex flex-col sm:flex-row items-center gap-4 rounded-2xl bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/30 dark:to-blue-900/30 p-6 sm:p-8">
      <div class="text-left">
        <h3 class="text-xl font-bold text-gray-900 dark:text-white">¿Buscas otro destino?</h3>
        <p class="text-gray-600 dark:text-gray-400 mt-1">Explora todas las casas particulares disponibles en Cuba</p>
      </div>
      <div class="flex-shrink-0">
        <a
          href="<?= BASE_URL ?>rents"
          class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500
                 px-8 py-3 text-base font-semibold text-white shadow-lg transition-all
                 hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl hover:-translate-y-0.5">
          <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
          </svg>
          Ver todos los destinos
        </a>
      </div>
    </div>
  </div>
</div>