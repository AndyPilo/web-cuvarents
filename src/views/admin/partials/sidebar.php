<?php
$activeMenu = $activeMenu ?? '';

// Obtener usuario
if (isset($currentUser) && is_array($currentUser)) {
  $user = $currentUser;
} else {
  $user = Auth::user();
}

$username = $user['username'] ?? 'Nombre';
$email    = $user['email']    ?? 'Correo electrónico';

if (!function_exists('sidebar_is_active')) {
  function sidebar_is_active(string $item, string $activeMenu): string
  {
    // "active" bootstrap -> Tailwind (fondo + texto)
    return $item === $activeMenu
      ? ' bg-gray-100 text-gray-900 font-semibold'
      : ' text-gray-700 hover:bg-gray-50';
  }
}
?>

<!-- Top bar (solo mobile) -->
<nav class="lg:hidden mb-5 px-0">
  <div class="flex items-center justify-between">
    <a class="flex items-center gap-2" href="<?= BASE_URL ?>dashboard">
      <span class="shrink-0">
        <img
          src="<?= BASE_URL ?>assets/img/logo.png"
          class="-my-5"
          width="80"
          alt="Logo blanco de CuVaRents"
          loading="lazy">
      </span>
      <span class="text-2xl font-bold leading-none">CuVaRents</span>
    </a>

    <!-- Botón abrir sidebar (mobile) -->
    <button
      id="openSidebarBtn"
      class="inline-flex items-center justify-center rounded-full border border-gray-300 px-4 py-2 text-gray-700 hover:bg-gray-50"
      type="button"
      aria-controls="accountSidebar"
      aria-expanded="false">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
        viewBox="0 0 24 24" fill="none" stroke="currentColor"
        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M7 6h10" />
        <path d="M4 12h16" />
        <path d="M7 18h10" />
      </svg>
    </button>
  </div>
</nav>

<!-- Sidebar -->
<aside class="lg:col-span-3">
  <!-- Overlay (solo mobile) -->
  <div id="sidebarOverlay" class="fixed inset-0 z-40 hidden bg-black/40 lg:hidden"></div>

  <!-- Drawer -->
  <div
    id="accountSidebar"
    class="fixed inset-y-0 left-0 z-50 w-80 max-w-[90vw] -translate-x-full bg-white shadow-xl transition-transform duration-300 lg:static lg:z-auto lg:w-auto lg:max-w-none lg:translate-x-0 lg:bg-transparent lg:shadow-none lg:pr-3 xl:pr-4"
    role="dialog"
    aria-modal="true">
    <!-- Header -->
    <div class="block py-3 lg:py-0 lg:p-0">
      <div class="flex flex-row items-center lg:flex-col lg:items-start">
        <div
          class="bg-gradient-al h-16 w-16 shrink-0 overflow-hidden rounded-full border"></div>

        <div class="ps-3 lg:ps-0 lg:pt-3">
          <h6 class="mb-1 text-sm font-semibold text-gray-900">
            <?= htmlspecialchars($username, ENT_QUOTES, 'UTF-8') ?>
          </h6>
          <p class="mb-0 text-sm text-gray-500">
            <?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8') ?>
          </p>
        </div>

        <!-- Botón cerrar (solo mobile) -->
        <button
          id="closeSidebarBtn"
          class="ms-auto inline-flex items-center justify-center rounded-full border border-gray-300 px-3 py-2 text-gray-700 hover:bg-gray-50 lg:hidden"
          type="button"
          aria-label="Cerrar">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M18 6L6 18" />
            <path d="M6 6l12 12" />
          </svg>
        </button>
      </div>
    </div>

    <!-- Body -->
    <div class="block pt-2 lg:pt-4 lg:pb-0">
      <nav class="flex flex-col gap-2">

        <a class="flex items-center rounded-full px-4 py-3 transition<?= sidebar_is_active('dashboard', $activeMenu) ?>"
          href="<?= BASE_URL ?>dashboard">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
            <path d="M4 9h8" />
            <path d="M12 15h8" />
            <path d="M12 4v16" />
          </svg>
          Dashboard
        </a>

        <a class="flex items-center rounded-full px-4 py-3 transition<?= sidebar_is_active('rents', $activeMenu) ?>"
          href="<?= BASE_URL ?>dashboard/rents">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.645 0 1.218 .305 1.584 .78" />
            <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4" />
            <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
          </svg>
          Gestionar rentas
        </a>

        <a class="flex items-center rounded-full px-4 py-3 transition<?= sidebar_is_active('reviews', $activeMenu) ?>"
          href="<?= BASE_URL ?>dashboard/reviews">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" />
            <path d="M12.454 19.97a9.9 9.9 0 0 1 -4.754 -.97l-4.7 1l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c1.667 1.423 2.596 3.294 2.747 5.216" />
          </svg>
          Recomendaciones
        </a>

        <a class="flex items-center rounded-full px-4 py-3 transition<?= sidebar_is_active('services', $activeMenu) ?>"
          href="<?= BASE_URL ?>dashboard/services">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 18l.01 0" />
            <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
            <path d="M6.343 12.343a8 8 0 0 1 11.314 0" />
            <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0" />
          </svg>
          Servicios de rentas
        </a>

        <a class="flex items-center rounded-full px-4 py-3 transition<?= sidebar_is_active('reservas', $activeMenu) ?>"
          href="<?= BASE_URL ?>dashboard/reservas">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
            <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
            <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
            <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
            <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
            <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
            <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
            <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
            <path d="M9 12l2 2l4 -4" />
          </svg>
          Sistema de Reservas
        </a>

        <a class="flex items-center rounded-full px-4 py-3 transition<?= sidebar_is_active('profile', $activeMenu) ?>"
          href="<?= BASE_URL ?>dashboard/profile">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
          </svg>
          Configuraciones
        </a>

        <a class="flex items-center rounded-full px-4 py-3 text-gray-700 transition hover:bg-gray-50"
          href="<?= BASE_URL ?>">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
            <path d="M15 12h-12l3 -3" />
            <path d="M6 15l-3 -3" />
          </svg>
          Ir al sitio web
        </a>
      </nav>

      <nav class="pt-3 flex">
        <a class="inline-flex items-center rounded-full bg-red-600 px-5 py-3 text-white transition hover:bg-red-700"
          href="<?= BASE_URL ?>logout">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
            viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
            class="me-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
            <path d="M15 12h-12l3 -3" />
            <path d="M6 15l-3 -3" />
          </svg>
          Cerrar sesión
        </a>
      </nav>
    </div>
  </div>
</aside>

<script>
  // Gradiente aleatorio para el avatar (igual que antes)
  document.addEventListener("DOMContentLoaded", function() {
    function getRandomColor() {
      return '#' + Math.floor(Math.random() * 16777215).toString(16);
    }

    function applyRandomGradient(element) {
      const color1 = getRandomColor();
      const color2 = getRandomColor();
      element.style.backgroundImage = `linear-gradient(45deg, ${color1}, ${color2})`;
    }
    document.querySelectorAll('.bg-gradient-al').forEach(applyRandomGradient);
  });

  // Offcanvas (Tailwind) - reemplazo de data-bs-toggle/offcanvas
  document.addEventListener("DOMContentLoaded", function() {
    const sidebar = document.getElementById("accountSidebar");
    const overlay = document.getElementById("sidebarOverlay");
    const openBtn = document.getElementById("openSidebarBtn");
    const closeBtn = document.getElementById("closeSidebarBtn");

    function openSidebar() {
      sidebar.classList.remove("-translate-x-full");
      overlay.classList.remove("hidden");
      openBtn?.setAttribute("aria-expanded", "true");
      document.documentElement.classList.add("overflow-hidden");
    }

    function closeSidebar() {
      sidebar.classList.add("-translate-x-full");
      overlay.classList.add("hidden");
      openBtn?.setAttribute("aria-expanded", "false");
      document.documentElement.classList.remove("overflow-hidden");
    }

    openBtn?.addEventListener("click", openSidebar);
    closeBtn?.addEventListener("click", closeSidebar);
    overlay?.addEventListener("click", closeSidebar);

    document.addEventListener("keydown", (e) => {
      if (e.key === "Escape") closeSidebar();
    });

    // En lg+ el sidebar siempre “abierto” sin overlay
    const mq = window.matchMedia("(min-width: 1024px)");

    function handleMQ() {
      if (mq.matches) {
        overlay.classList.add("hidden");
        sidebar.classList.remove("-translate-x-full");
        document.documentElement.classList.remove("overflow-hidden");
      } else {
        sidebar.classList.add("-translate-x-full");
      }
    }
    handleMQ();
    mq.addEventListener?.("change", handleMQ);
  });
</script>