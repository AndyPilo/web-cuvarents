<?php include_once __DIR__ . '/../../includes/header.php'; ?>

<body class="bg-gray-50 dark:bg-gray-900">
  <?php include_once __DIR__ . '/../../includes/navbar.php'; ?>

  <main class="relative overflow-hidden">
    <!-- Hero section con gradiente -->
    <div class="relative  pt-20 pb-16 sm:pt-24 sm:pb-20">


      <div class="relative mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <div class="inline-flex items-center justify-center mb-6">
            <span class="inline-flex items-center rounded-full bg-cyan-100 dark:bg-cyan-900/30 px-4 py-2 text-sm font-medium text-cyan-800 dark:text-cyan-300">
              <svg class="mr-2 h-5 w-5" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
              </svg>
              Desde 2023
            </span>
          </div>

          <h1 class="text-4xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-5xl md:text-6xl">
            <span class="block">Reinventando la experiencia</span>
            <span class="block text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500">inmobiliaria en Cuba</span>
          </h1>

          <p class="mx-auto mt-6 max-w-2xl text-lg sm:text-xl text-gray-600 dark:text-gray-300">
            En Cuvarents, conectamos personas con sus hogares ideales a través de tecnología innovadora y un servicio personalizado que transforma la búsqueda de propiedades.
          </p>

          <div class="mt-10 flex flex-col sm:flex-row gap-4 justify-center">
            <a href="<?= BASE_URL ?>rents" class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 px-8 py-4 text-base font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-cyan-400">
              <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              Explorar Propiedades
            </a>
            <a href="#nuestra-mision" class="inline-flex items-center justify-center rounded-xl border border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 px-8 py-4 text-base font-semibold text-gray-800 dark:text-gray-300 shadow-sm transition-all hover:bg-gray-50 dark:hover:bg-gray-700 hover:shadow-md hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-cyan-400">
              <svg class="mr-2 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              Conócenos Más
            </a>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección de estadísticas -->
    <div class="relative -mt-8 sm:-mt-12">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-4xl">
          <div class="grid grid-cols-2 gap-4 sm:grid-cols-4 sm:gap-8">
            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-6 text-center shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
              <div class="text-3xl font-bold text-cyan-700 dark:text-cyan-400 sm:text-4xl">500+</div>
              <div class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Propiedades Listadas</div>
              <div class="absolute -top-2 left-1/2 -translate-x-1/2 rounded-full bg-cyan-100 dark:bg-cyan-900/30 p-2">
                <svg class="h-5 w-5 text-cyan-600 dark:text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>

            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-6 text-center shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
              <div class="text-3xl font-bold text-cyan-700 dark:text-cyan-400 sm:text-4xl">15</div>
              <div class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Provincias Cubiertas</div>
              <div class="absolute -top-2 left-1/2 -translate-x-1/2 rounded-full bg-cyan-100 dark:bg-cyan-900/30 p-2">
                <svg class="h-5 w-5 text-cyan-600 dark:text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>

            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-6 text-center shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
              <div class="text-3xl font-bold text-cyan-700 dark:text-cyan-400 sm:text-4xl">2,500+</div>
              <div class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Clientes Satisfechos</div>
              <div class="absolute -top-2 left-1/2 -translate-x-1/2 rounded-full bg-cyan-100 dark:bg-cyan-900/30 p-2">
                <svg class="h-5 w-5 text-cyan-600 dark:text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>

            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-6 text-center shadow-lg ring-1 ring-gray-200 dark:ring-gray-700">
              <div class="text-3xl font-bold text-cyan-700 dark:text-cyan-400 sm:text-4xl">98%</div>
              <div class="mt-2 text-sm font-medium text-gray-600 dark:text-gray-400">Tasa de Satisfacción</div>
              <div class="absolute -top-2 left-1/2 -translate-x-1/2 rounded-full bg-cyan-100 dark:bg-cyan-900/30 p-2">
                <svg class="h-5 w-5 text-cyan-600 dark:text-cyan-400" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección principal de contenido -->
    <div class="py-16 sm:py-24" id="nuestra-mision">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="lg:grid lg:grid-cols-12 lg:gap-16">
          <!-- Texto -->
          <div class="lg:col-span-6 xl:col-span-7">
            <div class="lg:pr-8 xl:pr-12">
              <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
                Nuestra Misión: Transformar la búsqueda de hogar
              </h2>

              <p class="mt-6 text-lg text-gray-600 dark:text-gray-300">
                En <span class="font-semibold text-cyan-700 dark:text-cyan-400">Cuvarents</span>, entendemos que encontrar el hogar perfecto es más que una simple transacción; es un viaje emocional hacia el lugar donde crearás recuerdos inolvidables.
              </p>

              <div class="mt-10 space-y-8">
                <div class="relative pl-10">
                  <div class="absolute left-0 top-0 flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Selección Rigurosa</h3>
                  <p class="mt-2 text-gray-600 dark:text-gray-300">Cada propiedad en nuestra plataforma pasa por un riguroso proceso de verificación para garantizar calidad, seguridad y comodidad excepcionales.</p>
                </div>

                <div class="relative pl-10">
                  <div class="absolute left-0 top-0 flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Tecnología Intuitiva</h3>
                  <p class="mt-2 text-gray-600 dark:text-gray-300">Nuestra plataforma utiliza filtros avanzados que te permiten encontrar exactamente lo que buscas por ubicación, precio, tipo de propiedad y características específicas.</p>
                </div>

                <div class="relative pl-10">
                  <div class="absolute left-0 top-0 flex h-7 w-7 items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500">
                    <svg class="h-4 w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                  </div>
                  <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Asesoramiento Personalizado</h3>
                  <p class="mt-2 text-gray-600 dark:text-gray-300">Nuestro equipo de expertos está disponible para guiarte en cada paso, desde la búsqueda inicial hasta el momento de mudanza.</p>
                </div>
              </div>

              <div class="mt-12 rounded-2xl bg-gradient-to-r from-cyan-50 to-blue-50 dark:from-cyan-900/30 dark:to-blue-900/30 p-6 sm:p-8">
                <p class="text-lg italic text-gray-700 dark:text-gray-300">
                  "En Cuvarents, no solo te ayudamos a encontrar una propiedad; te acompañamos en el proceso de descubrir el lugar que llamarás hogar."
                </p>
                <div class="mt-4 flex items-center">
                  <div class="ml-4">
                    <div class="text-base font-semibold text-gray-900 dark:text-white">Equipo Cuvarents</div>
                    <div class="text-sm text-gray-600 dark:text-gray-400">Nuestro compromiso con tu satisfacción</div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Galería de imágenes moderna -->
          <div class="mt-12 lg:col-span-6 xl:col-span-5 lg:mt-0">
            <div class="relative">
              <!-- Imagen principal -->
              <div class="relative overflow-hidden rounded-3xl shadow-2xl dark:shadow-gray-900/50">
                <img
                  src="<?= BASE_URL ?>assets/img/about1.webp"
                  alt="Sala de una casa moderna en Cuba"
                  loading="lazy"
                  class="h-[400px] w-full object-cover transition-transform duration-500 hover:scale-105">
                <div class="absolute inset-0 bg-gradient-to-t from-black/30 to-transparent rounded-3xl"></div>
                <div class="absolute bottom-6 left-6 text-white">
                  <p class="text-sm font-medium">Propiedades Premium</p>
                  <p class="text-2xl font-bold">Calidad Verificada</p>
                </div>
              </div>

              <!-- Imágenes secundarias con efecto flotante -->
              <div class="relative -mt-20 ml-12 sm:ml-20 md:ml-24">
                <div class="grid grid-cols-2 gap-4">
                  <div class="overflow-hidden rounded-2xl shadow-xl dark:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl dark:hover:shadow-gray-900">
                    <img
                      src="<?= BASE_URL ?>assets/img/about2.webp"
                      alt="Cocina moderna con mesa de madera"
                      loading="lazy"
                      class="h-48 w-full object-cover">
                  </div>
                  <div class="overflow-hidden rounded-2xl shadow-xl dark:shadow-gray-900/50 transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl dark:hover:shadow-gray-900">
                    <img
                      src="<?= BASE_URL ?>assets/img/about3.webp"
                      alt="Baño moderno con regadera de cristal"
                      loading="lazy"
                      class="h-48 w-full object-cover">
                  </div>
                </div>
              </div>

              <!-- Elemento decorativo -->
              <div class="absolute -top-6 -right-6 hidden lg:block">
                <div class="relative">
                  <div class="h-24 w-24 rounded-full bg-gradient-to-r from-cyan-400 to-blue-500 opacity-20 dark:opacity-30 blur-xl"></div>
                  <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 dark:from-cyan-600 dark:to-blue-700 p-3 shadow-lg">
                    <svg class="h-8 w-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                      <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
                    </svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Sección de características -->
    <div class=" py-16 sm:py-24">
      <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center">
          <h2 class="text-3xl font-bold tracking-tight text-gray-900 dark:text-white sm:text-4xl">
            ¿Por qué elegir Cuvarents?
          </h2>
          <p class="mx-auto mt-4 max-w-2xl text-lg text-gray-600 dark:text-gray-300">
            Descubre las ventajas que nos convierten en la plataforma preferida para encontrar propiedades en Cuba
          </p>
        </div>

        <div class="mt-16">
          <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-3">
            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg dark:shadow-gray-900/50 transition-all hover:shadow-xl dark:hover:shadow-gray-900 hover:-translate-y-1">
              <div class="absolute -top-4 left-8 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 dark:from-cyan-600 dark:to-blue-600 shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                </svg>
              </div>
              <h3 class="mt-8 text-xl font-bold text-gray-900 dark:text-white">Cobertura Nacional</h3>
              <p class="mt-4 text-gray-600 dark:text-gray-300">Propiedades en las 15 provincias de Cuba, desde La Habana hasta Santiago de Cuba, con opciones urbanas y rurales.</p>
            </div>

            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg dark:shadow-gray-900/50 transition-all hover:shadow-xl dark:hover:shadow-gray-900 hover:-translate-y-1">
              <div class="absolute -top-4 left-8 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 dark:from-cyan-600 dark:to-blue-600 shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
              </div>
              <h3 class="mt-8 text-xl font-bold text-gray-900 dark:text-white">Verificación de Calidad</h3>
              <p class="mt-4 text-gray-600 dark:text-gray-300">Cada propiedad es inspeccionada personalmente para garantizar que cumple con nuestros estándares de excelencia.</p>
            </div>

            <div class="relative rounded-2xl bg-white dark:bg-gray-800 p-8 shadow-lg dark:shadow-gray-900/50 transition-all hover:shadow-xl dark:hover:shadow-gray-900 hover:-translate-y-1">
              <div class="absolute -top-4 left-8 flex h-12 w-12 items-center justify-center rounded-xl bg-gradient-to-r from-cyan-500 to-blue-500 dark:from-cyan-600 dark:to-blue-600 shadow-lg">
                <svg class="h-6 w-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                </svg>
              </div>
              <h3 class="mt-8 text-xl font-bold text-gray-900 dark:text-white">Soporte 24/7</h3>
              <p class="mt-4 text-gray-600 dark:text-gray-300">Nuestro equipo está disponible para responder tus preguntas y ayudarte en cualquier momento del proceso.</p>
            </div>
          </div>
        </div>

        <div class="mt-16 text-center">
          <a
            href="<?= BASE_URL ?>rents"
            class="inline-flex items-center justify-center rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 dark:from-cyan-500 dark:to-blue-500 px-10 py-4 text-lg font-semibold text-white shadow-lg transition-all hover:from-cyan-700 hover:to-blue-700 dark:hover:from-cyan-600 dark:hover:to-blue-600 hover:shadow-xl hover:-translate-y-0.5 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:ring-offset-2 dark:focus:ring-cyan-400">
            <svg class="mr-3 h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
            Encuentra Tu Hogar Ideal
          </a>
        </div>
      </div>
    </div>
  </main>

  <?php include_once __DIR__ . '/../../includes/footer.php'; ?>
</body>

</html>