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
              <h1 class="text-2xl font-semibold text-gray-900">Reservas</h1>

              <!-- Botón para abrir el modal (Tailwind) -->
              <button
                type="button"
                id="openAddGestorModal"
                class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-700">
                Agregar Gestor
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

            <!-- Modal para agregar gestores (Tailwind) -->
            <div
              class="fixed inset-0 z-50 hidden overflow-y-auto"
              id="addGestorModal"
              tabindex="-1"
              aria-labelledby="addGestorModalLabel"
              aria-hidden="true"
              role="dialog"
              aria-modal="true">
              <!-- Overlay -->
              <div class="fixed inset-0 bg-black/50" data-gestor-overlay></div>

              <!-- Dialog -->
              <div class="relative mx-auto flex min-h-full w-full items-start justify-center px-3 py-6">
                <div class="w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black/10 flex flex-col max-h-[90vh]">

                  <!-- Header -->
                  <div class="flex items-center justify-between border-b border-gray-200 px-4 py-4 sm:px-6 flex-none">
                    <h5 class="text-lg font-semibold text-gray-900" id="addGestorModalLabel">Agregar Gestor</h5>
                    <button
                      type="button"
                      class="inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900"
                      aria-label="Cerrar"
                      data-gestor-close>
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
                      id="addGestorForm"
                      action="<?= BASE_URL ?>dashboard/reservas/store"
                      method="POST"
                      class="space-y-4">
                      <div>
                        <label for="nombre" class="mb-1 block text-sm font-medium text-gray-900">Nombre del Gestor</label>
                        <input
                          type="text"
                          class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30"
                          id="nombre"
                          name="nombre"
                          required>
                      </div>

                      <div>
                        <label for="telefono" class="mb-1 block text-sm font-medium text-gray-900">Teléfono</label>
                        <input
                          type="text"
                          class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30"
                          id="telefono"
                          name="telefono"
                          required>
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

            <!-- Tabla de gestores -->
            <h3 class="mt-6 text-lg font-semibold text-gray-900">Gestores</h3>

            <div class="mt-3 overflow-hidden rounded-2xl border border-gray-200 bg-white">
              <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">ID</th>
                      <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                      <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Teléfono</th>
                      <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Activo</th>
                      <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600" style="min-width: 180px;">Acciones</th>
                    </tr>
                  </thead>

                  <tbody class="divide-y divide-gray-100 bg-white">
                    <?php if (!empty($gestores)): ?>
                      <?php foreach ($gestores as $row): ?>
                        <?php
                        $id       = (int)$row['id'];
                        $nombre   = htmlspecialchars($row['nombre']   ?? '', ENT_QUOTES, 'UTF-8');
                        $telefono = htmlspecialchars($row['telefono'] ?? '', ENT_QUOTES, 'UTF-8');
                        $activo   = (int)($row['activo'] ?? 0);
                        ?>
                        <tr class="hover:bg-gray-50">
                          <td class="px-4 py-4 text-sm text-gray-900"><?= $id ?></td>
                          <td class="px-4 py-4 text-sm font-medium text-gray-900"><?= $nombre ?></td>
                          <td class="px-4 py-4 text-sm text-gray-700"><?= $telefono ?></td>
                          <td class="px-4 py-4 text-sm">
                            <?php if ($activo): ?>
                              <span class="inline-flex items-center rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-emerald-200">
                                Sí
                              </span>
                            <?php else: ?>
                              <span class="inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700 ring-1 ring-gray-200">
                                No
                              </span>
                            <?php endif; ?>
                          </td>
                          <td class="px-4 py-4">
                            <div class="flex flex-wrap gap-2">

                              <?php if (!$activo): ?>
                                <!-- Activar -->
                                <form
                                  class="activate-gestor-form"
                                  action="<?= BASE_URL ?>dashboard/reservas/activate"
                                  method="POST">
                                  <input type="hidden" name="id" value="<?= $id ?>">
                                  <button type="submit"
                                    class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                                    Activar
                                  </button>
                                </form>
                              <?php endif; ?>

                              <!-- Eliminar -->
                              <form
                                class="delete-gestor-form"
                                action="<?= BASE_URL ?>dashboard/reservas/delete"
                                method="POST">
                                <input type="hidden" name="id" value="<?= $id ?>">

                                <?php if (!$activo): ?>
                                  <button type="submit"
                                    class="inline-flex items-center justify-center rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700"
                                    aria-label="Eliminar">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                      width="16" height="16"
                                      viewBox="0 0 24 24"
                                      fill="none"
                                      stroke="currentColor"
                                      stroke-width="2"
                                      stroke-linecap="round"
                                      stroke-linejoin="round"
                                      class="mr-2">
                                      <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                      <path d="M4 7h16" />
                                      <path d="M10 11v6" />
                                      <path d="M14 11v6" />
                                      <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                      <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                    </svg>
                                    Eliminar
                                  </button>
                                <?php else: ?>
                                  <button type="submit"
                                    class="inline-flex items-center justify-center rounded-full bg-red-200 px-4 py-2 text-sm font-semibold text-red-700 cursor-not-allowed"
                                    disabled>
                                    Eliminar
                                  </button>
                                <?php endif; ?>
                              </form>

                            </div>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    <?php else: ?>
                      <tr>
                        <td colspan="5" class="px-4 py-6 text-sm text-gray-600">No hay gestores disponibles.</td>
                      </tr>
                    <?php endif; ?>
                  </tbody>
                </table>
              </div>
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
    // Modal Tailwind (Agregar Gestor)
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('addGestorModal');
      const overlay = modal?.querySelector('[data-gestor-overlay]');
      const closeBtn = modal?.querySelector('[data-gestor-close]');
      const openBtn = document.getElementById('openAddGestorModal');

      function openModal() {
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('overflow-hidden');
        setTimeout(() => modal.querySelector('input, button')?.focus?.(), 0);
      }

      function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('overflow-hidden');
        document.getElementById('addGestorForm')?.reset?.();
      }

      openBtn?.addEventListener('click', openModal);
      overlay?.addEventListener('click', closeModal);
      closeBtn?.addEventListener('click', closeModal);
      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
      });
    });

    // SweetAlert confirm (igual lógica)
    function confirmForm(selector, title, text, icon, confirmText) {
      document.querySelectorAll(selector).forEach(function(form) {
        form.addEventListener('submit', function(e) {
          e.preventDefault();

          Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: confirmText,
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit();
            }
          });
        });
      });
    }

    confirmForm('.activate-gestor-form',
      '¿Activar gestor?',
      'El gestor podrá ser usado para asignar reservas.',
      'info',
      'Sí, activar');

    confirmForm('.delete-gestor-form',
      '¿Eliminar gestor?',
      'Esta acción no se puede deshacer y solo es posible si el gestor no está activo.',
      'warning',
      'Sí, eliminar');
  </script>

</body>

</html>