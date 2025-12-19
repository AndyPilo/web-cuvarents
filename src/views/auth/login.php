<?php
include_once __DIR__ . '/../../../includes/header.php';
?>

<body>
  <main class="w-full px-3 lg:pl-5 lg:pr-4 mx-auto" style="max-width: 1920px">
    <div class="lg:flex">

      <!-- Columna izquierda -->
      <div class="flex flex-col min-h-screen w-full py-4 mx-auto lg:mr-5" style="max-width: 416px">
        <header class="flex items-center px-0 pb-4 -mt-2 sm:mt-0 mb-2 md:mb-3 lg:mb-4">
          <a class="inline-flex items-center gap-2 font-semibold text-gray-900 no-underline" href="<?= BASE_URL ?>">
            <img src="<?= BASE_URL ?>assets/img/logo.png" width="80" alt="Logo CuVaRents" loading="lazy">
            <span>CuVaRents</span>
          </a>
        </header>

        <h1 class="text-2xl font-semibold mt-auto text-gray-900">Bienvenido</h1>

        <div class="text-sm text-gray-700 mb-4">
          ¿No tienes una cuenta?
          <a
            class="underline underline-offset-2 p-0 ml-2 text-gray-900 hover:text-gray-700"
            href="<?= BASE_URL ?>register">
            Crear una cuenta
          </a>
        </div>

        <?php
        if (empty($success) && isset($_GET['registered'])) {
          $success = 'Cuenta creada correctamente. Inicia sesión para continuar.';
        }
        ?>

        <?php if (!empty($error)): ?>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: <?= json_encode($error, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
            });
          </script>
        <?php endif; ?>

        <?php if (!empty($success)): ?>
          <script>
            Swal.fire({
              icon: 'success',
              title: '¡Listo!',
              text: <?= json_encode($success, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
            });
          </script>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>login">
          <div class="mb-3">
            <input
              type="email"
              name="email"
              placeholder="Correo electrónico"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base
                     placeholder:text-gray-400 shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
          </div>

          <div class="mb-3">
            <!-- Mantengo tus clases custom por si ya tienes JS/CSS para toggle -->
            <div class="password-toggle relative">
              <input
                type="password"
                name="password"
                placeholder="Contraseña"
                required
                class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 pr-12 text-base
                       placeholder:text-gray-400 shadow-sm
                       focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">

              <label
                class="password-toggle-button absolute inset-y-0 right-0 flex items-center pr-3 text-lg text-gray-500 cursor-pointer"
                aria-label="Mostrar/ocultar contraseña">
                <input type="checkbox" class="sr-only">
                <!-- Icono simple (puedes reemplazarlo por el tuyo) -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                  <path d="M10 4c-4.5 0-8.1 3-9.5 6 1.4 3 5 6 9.5 6s8.1-3 9.5-6C18.1 7 14.5 4 10 4Zm0 10a4 4 0 1 1 0-8 4 4 0 0 1 0 8Z" />
                  <path d="M10 8a2 2 0 1 0 0 4 2 2 0 0 0 0-4Z" />
                </svg>
              </label>
            </div>
          </div>

          <button
            type="submit"
            class="w-full rounded-lg bg-sky-500 px-4 py-3 text-base font-semibold text-white
                   hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
            Iniciar sesión
          </button>
        </form>

        <footer class="mt-auto text-center pt-4 md:pb-2">
          <p class="text-gray-500 text-sm mb-0">© 2025 CuVaRents. Todos los derechos reservados.</p>
        </footer>
      </div>

      <!-- Columna derecha -->
      <div class="hidden lg:block w-full py-4 ml-auto" style="max-width: 1034px">
        <div
          class="flex flex-col justify-end h-full rounded-[2rem] bg-sky-50"
          style="background-image: url('<?= BASE_URL ?>assets/img/login.webp'); background-size: cover;"></div>
      </div>

    </div>
  </main>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>