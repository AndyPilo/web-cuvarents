<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body>

  <main class="content-wrapper">
    <div class="mx-auto max-w-7xl px-4 pt-4 pb-5 sm:px-6 sm:pt-5 lg:px-8">
      <div class="pt-2 pb-2 sm:pt-0 sm:pb-3 md:pb-4 lg:pt-2 lg:pb-5">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
          <?php include __DIR__ . '/partials/sidebar.php'; ?>

          <!-- Contenido principal -->
          <div class="lg:col-span-9">

            <div class="flex items-center justify-between pb-5">
              <h1 class="text-2xl font-semibold text-gray-900">Servicios de rentas</h1>

              <!-- Botón para abrir el modal (Tailwind) -->
              <button
                type="button"
                id="openAddServiceModal"
                class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-700">
                Agregar Servicio
              </button>
            </div>

            <!-- Flash messages -->
            <?php if ($msg = Session::flash('success')): ?>
              <div class="mb-4 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm text-emerald-800">
                <?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?>
              </div>
            <?php endif; ?>

            <?php if ($msg = Session::flash('error')): ?>
              <div class="mb-4 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                <?= htmlspecialchars($msg, ENT_QUOTES, 'UTF-8') ?>
              </div>
            <?php endif; ?>

            <!-- Modal para agregar servicios (Tailwind) -->
            <div
              class="fixed inset-0 z-50 hidden overflow-y-auto"
              id="addServiceModal"
              tabindex="-1"
              aria-labelledby="addServiceModalLabel"
              aria-hidden="true"
              role="dialog"
              aria-modal="true">
              <!-- Overlay -->
              <div class="fixed inset-0 bg-black/50" data-service-overlay></div>

              <!-- Dialog -->
              <div class="relative mx-auto flex min-h-full w-full items-start justify-center px-3 py-6">
                <div class="w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black/10 flex flex-col max-h-[90vh]">

                  <!-- Header -->
                  <div class="flex items-center justify-between border-b border-gray-200 px-4 py-4 sm:px-6 flex-none">
                    <h5 class="text-lg font-semibold text-gray-900" id="addServiceModalLabel">Agregar Servicio</h5>
                    <button
                      type="button"
                      class="inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900"
                      aria-label="Cerrar"
                      data-service-close>
                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 6L6 18"></path>
                        <path d="M6 6l12 12"></path>
                      </svg>
                    </button>
                  </div>

                  <!-- Body (scroll) -->
                  <div class="px-4 py-5 sm:px-6 flex-1 overflow-y-auto">
                    <form
                      id="addServiceForm"
                      action="<?= BASE_URL ?>dashboard/services/store"
                      method="POST"
                      class="space-y-4">
                      <div>
                        <label for="serviceName" class="mb-1 block text-sm font-medium text-gray-900">Nombre del Servicio</label>
                        <input
                          type="text"
                          id="serviceName"
                          name="serviceName"
                          required
                          class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
                      </div>

                      <div>
                        <label for="serviceIcon" class="mb-1 block text-sm font-medium text-gray-900">Icono del Servicio</label>
                        <select
                          id="serviceIcon"
                          name="serviceIcon"
                          required
                          class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30">
                          <option value='<i class="fi-wifi fs-lg me-2"></i>'>WiFi</option>
                          <option value='<i class="fi-dishwasher fs-lg me-2"></i>'>Lavavajillas</option>
                          <option value='<i class="fi-snowflake fs-lg me-2"></i>'>Aire acondicionado</option>
                          <option value='<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-car-garage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M15 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M5 20h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" /><path d="M3 6l9 -4l9 4" /></svg>'>Lugar de estacionamiento</option>
                          <option value='<i class="fi-washing-machine fs-lg me-2"></i>'>Lavandería</option>
                          <option value='<i class="fi-iron fs-lg me-2"></i>'>Plancha</option>
                          <option value='<i class="fi-video fs-lg me-2"></i>'>Cámaras de seguridad</option>
                          <option value='<i class="fi-no-smoking fs-lg me-2"></i>'>Prohibido fumar</option>
                          <option value='<i class="fi-paw fs-lg me-2"></i>'>Se permiten mascotas</option>
                          <option value='<i class="fi-coffee"></i>'>Café</option>
                          <option value='<i class="fi-food"></i>'>Comida</option>
                          <option value='<i class="fi-fork-knife"></i>'>Cuchara y Tenedor</option>
                          <option value='<i class="fi-shower"></i>'>Ducha</option>
                          <option value='<i class="fi-washing-machine"></i>'>Lavadora</option>
                          <option value='<i class="fi-wheelchair"></i>'>Accesibilidad</option>
                          <option value='<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-massage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M9 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 22l4 -2v-3h12" /><path d="M11 20h9" /><path d="M8 14l3 -2l1 -4c3 1 3 4 3 6" /></svg>'>Masajes</option>
                          <option value='<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-pool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1" /><path d="M2 16a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1" /><path d="M15 12v-7.5a1.5 1.5 0 0 1 3 0" /><path d="M9 12v-7.5a1.5 1.5 0 0 0 -3 0" /><path d="M15 5l-6 0" /><path d="M9 10l6 0" /></svg>'>Piscina</option>
                          <option value='<i class="fi-check-circle"></i>'>Icono default para otros</option>
                        </select>
                      </div>

                      <button type="submit"
                        class="mt-3 w-full rounded-full bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black">
                        Guardar
                      </button>
                    </form>
                  </div>

                </div>
              </div>
            </div>

            <!-- Listado de servicios -->
            <div class="mt-4 space-y-3">
              <?php if (!empty($services)): ?>
                <?php foreach ($services as $row): ?>
                  <?php
                  $serviceId   = htmlspecialchars($row['id']   ?? '', ENT_QUOTES, 'UTF-8');
                  $serviceName = htmlspecialchars($row['name'] ?? '', ENT_QUOTES, 'UTF-8');
                  $serviceIcon = $row['icon'] ?? '';
                  ?>

                  <article class="w-full rounded-2xl border border-gray-200 bg-white shadow-sm">
                    <div class="grid grid-cols-1 gap-4 p-4 sm:grid-cols-12 sm:items-center">

                      <div class="sm:col-span-2 flex items-center justify-center">
                        <div class="service-icon text-3xl text-gray-800">
                          <?= $serviceIcon ?>
                        </div>
                      </div>

                      <div class="sm:col-span-8">
                        <div class="text-base font-semibold text-gray-900">
                          <?= $serviceName ?>
                        </div>
                      </div>

                      <div class="sm:col-span-2 sm:text-right">
                        <form
                          class="delete-service-form inline-block"
                          action="<?= BASE_URL ?>dashboard/services/delete"
                          method="POST">
                          <input type="hidden" name="service_id" value="<?= $serviceId ?>">
                          <button type="submit"
                            class="inline-flex items-center justify-center rounded-full border border-red-300 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-50">
                            Eliminar
                          </button>
                        </form>
                      </div>

                    </div>
                  </article>

                <?php endforeach; ?>
              <?php else: ?>
                <p class="text-sm text-gray-600">No hay servicios disponibles.</p>
              <?php endif; ?>
            </div>

          </div>
        </div>

      </div>
    </div>
  </main>

  <!-- Vendor scripts -->
  <script src="<?= BASE_URL ?>assets/js/glightbox.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/choices.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/nouislider.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Modal Tailwind (Agregar Servicio)
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('addServiceModal');
      const overlay = modal?.querySelector('[data-service-overlay]');
      const closeBtn = modal?.querySelector('[data-service-close]');
      const openBtn = document.getElementById('openAddServiceModal');

      function openModal() {
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('overflow-hidden');
        setTimeout(() => {
          const first = modal.querySelector('input, select, button');
          first?.focus?.();
        }, 0);
      }

      function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('overflow-hidden');
        document.getElementById('addServiceForm')?.reset?.();
      }

      openBtn?.addEventListener('click', openModal);
      overlay?.addEventListener('click', closeModal);
      closeBtn?.addEventListener('click', closeModal);

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
      });
    });

    // Confirmación al eliminar servicio (igual)
    document.querySelectorAll('.delete-service-form').forEach(function(form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
          title: '¿Eliminar servicio?',
          text: 'Esta acción no se puede deshacer.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#aaa',
          confirmButtonText: 'Sí, eliminar',
          cancelButtonText: 'Cancelar'
        }).then((result) => {
          if (result.isConfirmed) {
            form.submit();
          }
        });
      });
    });
  </script>

</body>

</html>