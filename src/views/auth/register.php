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
            <img src="<?= BASE_URL ?>assets/img/logo.png" width="80" alt="Logo CuVaRents">
            <span>CuVaRents</span>
          </a>
        </header>

        <h1 class="text-2xl font-semibold mt-auto text-gray-900">Crear una cuenta</h1>

        <div class="text-sm text-gray-700 mb-3 lg:mb-4">
          Ya tengo una cuenta
          <a
            class="underline underline-offset-2 p-0 ml-2 text-gray-900 hover:text-gray-700"
            href="<?= BASE_URL ?>login">
            Inicia sesión
          </a>
        </div>

        <?php if (!empty($error)): ?>
          <script>
            Swal.fire({
              icon: 'error',
              title: 'Oops...',
              text: <?= json_encode($error, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP) ?>
            });
          </script>
        <?php endif; ?>

        <form method="POST" action="<?= BASE_URL ?>register">
          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Nombre</label>
            <input
              type="text"
              name="name"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base
                     shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
          </div>

          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Email</label>
            <input
              type="email"
              name="email"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base
                     shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
          </div>

          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Contraseña</label>
            <input
              type="password"
              name="password"
              minlength="8"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base
                     shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
          </div>

          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Prefijo</label>
            <select
              name="phone_prefix"
              class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base
                     shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
              <option value="+53">+53 Cuba</option>
              <option value="+1">+1 EE.UU / Canadá</option>
              <option value="+34">+34 España</option>
            </select>
          </div>

          <div class="mb-3">
            <label class="block mb-1 text-sm font-medium text-gray-900">Teléfono</label>
            <input
              type="tel"
              name="phone_number"
              required
              class="w-full rounded-lg border border-gray-300 bg-white px-4 py-3 text-base
                     shadow-sm
                     focus:outline-none focus:ring-2 focus:ring-sky-500 focus:border-sky-500">
          </div>

          <button
            type="submit"
            class="w-full rounded-lg bg-sky-500 px-4 py-3 text-base font-semibold text-white
                   hover:bg-sky-600 focus:outline-none focus:ring-2 focus:ring-sky-500 focus:ring-offset-2">
            Crear cuenta
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
          style="background-image: url('<?= BASE_URL ?>assets/img/signup.webp'); background-size: cover; background-position: center;"></div>
      </div>
    </div>
  </main>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>