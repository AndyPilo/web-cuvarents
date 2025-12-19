<?php
$user = Auth::user();

$loggedIn     = $user !== null;
$accountRango = $user['rango']    ?? null;
$nombre       = $user['username'] ?? '';
$email        = $user['email']    ?? '';

// Inicial para el avatar
$initial = '?';
if (!empty($nombre)) {
  if (function_exists('mb_substr') && function_exists('mb_strtoupper')) {
    $initial = mb_strtoupper(mb_substr($nombre, 0, 1, 'UTF-8'), 'UTF-8');
  } else {
    $initial = strtoupper(substr($nombre, 0, 1));
  }
}
?>

<header class="sticky top-0 z-50 border-b border-gray-200/50 bg-white/95 backdrop-blur-md supports-[backdrop-filter]:bg-white/80 transition-all duration-300">
  <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
    <div class="flex h-16 items-center justify-between lg:h-20">

      <!-- Logo y navegación principal -->
      <div class="flex items-center gap-8">
        <!-- Logo mejorado -->
        <a href="<?= BASE_URL ?>" class="group flex items-center gap-3 no-underline">
          <div class="relative">
            <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full blur-md opacity-70 group-hover:opacity-90 transition-opacity"></div>
            <img
              src="<?= BASE_URL ?>assets/img/logo-white.webp"
              class="relative h-12 w-12 rounded-full border-2 border-gray-800/20 lg:h-12 lg:w-12"
              alt="CuVaRents Logo"
              loading="eager">
          </div>
          <div>
            <div class="text-xl font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent lg:text-xl">CuVaRents</div>
            <div class="text-xs text-gray-500 hidden sm:block">Casas particulares en Cuba</div>
          </div>
        </a>

        <!-- Navegación principal (desktop) -->
        <nav class="hidden lg:block">
          <ul class="flex flex-row items-center gap-1">
            <li>
              <a href="<?= BASE_URL ?>"
                class="group relative rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 no-underline transition-all duration-300 hover:text-cyan-700">
                <span class="relative z-10">Inicio</span>
                <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyan-50 to-blue-50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
              </a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>rents"
                class="group relative rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 no-underline transition-all duration-300 hover:text-cyan-700">
                <span class="relative z-10">Rentas</span>
                <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyan-50 to-blue-50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
              </a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>about"
                class="group relative rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 no-underline transition-all duration-300 hover:text-cyan-700">
                <span class="relative z-10">Quiénes somos</span>
                <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyan-50 to-blue-50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
              </a>
            </li>
            <li>
              <a href="<?= BASE_URL ?>contact"
                class="group relative rounded-lg px-4 py-2.5 text-sm font-medium text-gray-700 no-underline transition-all duration-300 hover:text-cyan-700">
                <span class="relative z-10">Contacto</span>
                <span class="absolute inset-0 rounded-lg bg-gradient-to-r from-cyan-50 to-blue-50 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></span>
              </a>
            </li>
          </ul>
        </nav>
      </div>

      <!-- Acciones del usuario (derecha) -->
      <div class="flex items-center gap-3">

        <!-- 
        Botón tema (desktop) 
        <div class="hidden lg:block">
          <div class="relative" data-dropdown>
            <button
              type="button"
              class="group flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-gray-100 to-white
                     text-gray-700 shadow-sm ring-1 ring-gray-200/50 transition-all duration-300
                     hover:shadow-md hover:ring-gray-300"
              data-dropdown-trigger
              aria-expanded="false"
              aria-label="Cambiar tema"
            >
              <svg class="h-5 w-5 transition-transform group-hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
              </svg>
            </button>

            <ul
              class="absolute right-0 mt-2 w-48 rounded-xl border border-gray-200/50 bg-white/95 p-2 shadow-xl backdrop-blur-md
                     hidden opacity-0 scale-95 pointer-events-none transition duration-150"
              data-dropdown-menu
            >
              <li>
                <button
                  type="button"
                  class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700
                         hover:bg-gray-100 hover:text-cyan-700 transition-colors"
                  data-theme-value="light"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                  </svg>
                  <span>Modo claro</span>
                </button>
              </li>

              <li>
                <button
                  type="button"
                  class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700
                         hover:bg-gray-100 hover:text-cyan-700 transition-colors"
                  data-theme-value="dark"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                  </svg>
                  <span>Modo oscuro</span>
                </button>
              </li>

              <li>
                <button
                  type="button"
                  class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700
                         hover:bg-gray-100 hover:text-cyan-700 transition-colors"
                  data-theme-value="auto"
                >
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4" />
                  </svg>
                  <span>Automático</span>
                </button>
              </li>
            </ul>
          </div>
        </div>

        -->

        <!-- Usuario (desktop) -->
        <div class="hidden lg:block">
          <?php if (!$loggedIn): ?>
            <div class="flex items-center gap-3">
              <a href="<?= BASE_URL ?>login"
                class="rounded-lg border border-gray-300 bg-white px-5 py-2.5 text-sm font-semibold text-gray-700 no-underline
                        transition-all duration-300 hover:border-cyan-500 hover:bg-cyan-50 hover:text-cyan-700 hover:shadow-sm">
                Iniciar sesión
              </a>
              <a href="<?= BASE_URL ?>auth/register"
                class="rounded-lg bg-gradient-to-r from-cyan-600 to-blue-600 px-5 py-2.5 text-sm font-semibold text-white no-underline
                        shadow-lg transition-all duration-300 hover:from-cyan-700 hover:to-blue-700 hover:shadow-xl hover:-translate-y-0.5">
                Registrarse
              </a>
            </div>
          <?php else: ?>
            <div class="relative" data-dropdown>
              <button
                class="group flex items-center gap-3 rounded-full p-1 transition-all duration-300 hover:bg-gray-100"
                data-dropdown-trigger
                aria-expanded="false">
                <div class="relative">
                  <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full blur-md opacity-70 group-hover:opacity-90 transition-opacity"></div>
                  <div class="relative flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 text-sm font-bold text-white">
                    <?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?>
                  </div>
                </div>
                <div class="text-left">
                  <div class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></div>
                  <div class="text-xs text-gray-500 truncate max-w-[120px]"><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></div>
                </div>
                <svg class="h-4 w-4 text-gray-500 transition-transform group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
              </button>

              <ul
                class="absolute right-0 mt-2 w-56 rounded-xl border border-gray-200/50 bg-white/95 p-2 shadow-xl backdrop-blur-md
                       hidden opacity-0 scale-95 pointer-events-none transition duration-150"
                data-dropdown-menu>
                <li class="px-3 py-3">
                  <div class="text-sm font-semibold text-gray-900"><?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></div>
                  <div class="text-xs text-gray-500 truncate"><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></div>
                </li>
                <li>
                  <hr class="my-2 border-gray-200">
                </li>

                <?php if ((int)$accountRango === 99): ?>
                  <li>
                    <a href="<?= BASE_URL ?>dashboard"
                      class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-gray-700 no-underline transition-all duration-300 hover:bg-cyan-50 hover:text-cyan-700">
                      <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                          d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                      </svg>
                      Dashboard
                    </a>
                  </li>
                <?php endif; ?>

                <li>
                  <a href="<?= BASE_URL ?>logout"
                    class="flex items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-red-600 no-underline transition-all duration-300 hover:bg-red-50">
                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Cerrar sesión
                  </a>
                </li>
              </ul>
            </div>
          <?php endif; ?>
        </div>

        <!-- Botón menú móvil -->
        <button
          type="button"
          class="inline-flex h-10 w-10 items-center justify-center rounded-full bg-gradient-to-br from-gray-100 to-white
                 text-gray-700 shadow-sm ring-1 ring-gray-200/50 transition-all duration-300 hover:shadow-md hover:ring-gray-300 lg:hidden"
          data-offcanvas-open="mobileMenu"
          aria-label="Abrir menú">
          <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 6h16M4 12h16M4 18h16" />
          </svg>
        </button>
      </div>
    </div>
  </div>
</header>

<!-- Backdrop offcanvas -->
<div
  class="fixed inset-0 z-[1040] hidden opacity-0 bg-black/50 backdrop-blur-sm transition-opacity duration-300"
  data-offcanvas-backdrop="mobileMenu"></div>

<!-- Menú móvil (offcanvas) -->
<aside
  id="mobileMenu"
  class="fixed inset-y-0 right-0 z-[1050] hidden w-full max-w-sm translate-x-full bg-white shadow-2xl
         transition-transform duration-300 ease-out lg:hidden"
  aria-hidden="true">
  <div class="flex flex-col h-full">
    <!-- Header del menú móvil -->
    <div class="flex items-center justify-between border-b border-gray-200/50 px-6 py-4">
      <div class="flex items-center gap-3">
        <div class="relative">
          <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full blur-md opacity-70"></div>
          <img
            src="<?= BASE_URL ?>assets/img/logo-white.webp"
            class="relative h-10 w-10 rounded-full border-2 border-gray-800/50"
            alt="CuVaRents Logo">
        </div>
        <div>
          <div class="text-lg font-bold bg-gradient-to-r from-cyan-600 to-blue-600 bg-clip-text text-transparent">CuVaRents</div>
          <div class="text-xs text-gray-500">Menú de navegación</div>
        </div>
      </div>

      <button
        type="button"
        class="flex h-8 w-8 items-center justify-center rounded-full bg-gray-100 text-gray-600 transition-colors hover:bg-gray-200"
        data-offcanvas-close="mobileMenu"
        aria-label="Cerrar menú">
        <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
      </button>
    </div>

    <!-- Contenido del menú móvil -->
    <div class="flex-1 overflow-y-auto px-6 py-6">
      <!-- Navegación móvil -->
      <nav class="mb-8">
        <ul class="space-y-1">
          <li>
            <a href="<?= BASE_URL ?>"
              class="group flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-900 no-underline transition-all duration-300 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50">
              <svg class="h-5 w-5 text-gray-500 group-hover:text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
              </svg>
              <span>Inicio</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>rents"
              class="group flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-900 no-underline transition-all duration-300 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50">
              <svg class="h-5 w-5 text-gray-500 group-hover:text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
              </svg>
              <span>Rentas</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>about"
              class="group flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-900 no-underline transition-all duration-300 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50">
              <svg class="h-5 w-5 text-gray-500 group-hover:text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
              </svg>
              <span>Quiénes somos</span>
            </a>
          </li>
          <li>
            <a href="<?= BASE_URL ?>contact"
              class="group flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-900 no-underline transition-all duration-300 hover:bg-gradient-to-r hover:from-cyan-50 hover:to-blue-50">
              <svg class="h-5 w-5 text-gray-500 group-hover:text-cyan-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
              </svg>
              <span>Contacto</span>
            </a>
          </li>
        </ul>
      </nav>

      <!-- Panel usuario móvil -->
      <div class="border-t border-gray-200/50 pt-8">
        <?php if (!$loggedIn): ?>
          <div class="space-y-3">
            <a href="<?= BASE_URL ?>login"
              class="flex w-full items-center justify-center gap-2 rounded-xl border border-gray-300 bg-white px-6 py-3 text-base font-medium text-gray-700 no-underline
                      transition-all duration-300 hover:border-cyan-500 hover:bg-cyan-50 hover:text-cyan-700">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
              </svg>
              Iniciar sesión
            </a>

            <a href="<?= BASE_URL ?>auth/register"
              class="flex w-full items-center justify-center gap-2 rounded-xl bg-gradient-to-r from-cyan-600 to-blue-600 px-6 py-3 text-base font-semibold text-white no-underline shadow-lg
                      transition-all duration-300 hover:from-cyan-700 hover:to-blue-700 hover:shadow-xl">
              <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                  d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
              </svg>
              Registrarse
            </a>
          </div>
        <?php else: ?>
          <div class="space-y-6">
            <div class="flex items-center gap-4 rounded-2xl bg-gradient-to-r from-cyan-50 to-blue-50 p-4">
              <div class="relative">
                <div class="absolute inset-0 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full blur-md opacity-70"></div>
                <div class="relative flex h-14 w-14 items-center justify-center rounded-full bg-gradient-to-r from-cyan-500 to-blue-500 text-lg font-bold text-white">
                  <?= htmlspecialchars($initial, ENT_QUOTES, 'UTF-8') ?>
                </div>
              </div>
              <div class="flex-1">
                <div class="text-base font-semibold text-gray-900"><?= htmlspecialchars($nombre, ENT_QUOTES, 'UTF-8') ?></div>
                <div class="text-sm text-gray-600 truncate"><?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?></div>
              </div>
            </div>

            <div class="space-y-2">
              <?php if ((int)$accountRango === 99): ?>
                <a href="<?= BASE_URL ?>dashboard"
                  class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-gray-700 no-underline transition-all duration-300 hover:bg-gray-100">
                  <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                      d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z" />
                  </svg>
                  Dashboard
                </a>
              <?php endif; ?>

              <a href="<?= BASE_URL ?>logout"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-base font-medium text-red-600 no-underline transition-all duration-300 hover:bg-red-50">
                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                Cerrar sesión
              </a>
            </div>
          </div>
        <?php endif; ?>
      </div>
    </div>
  </div>
</aside>