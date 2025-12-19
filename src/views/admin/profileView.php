<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body>

  <main class="content-wrapper">
    <div class="mx-auto max-w-7xl px-4 pt-4 pb-5 sm:px-6 sm:pt-5 lg:px-8">
      <div class="pt-2 pb-2 sm:pt-0 sm:pb-3 md:pb-4 lg:pt-2 lg:pb-5">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
          <?php include __DIR__ . '/partials/sidebar.php'; ?>

          <!-- Account settings content -->
          <div class="lg:col-span-9">
            <h1 class="pb-2 text-2xl font-semibold text-gray-900 lg:pb-3">Configuración de la web</h1>

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

            <!-- Tabs -->
            <div class="mb-3 overflow-x-auto">
              <div class="inline-flex gap-2 pb-2">
                <button
                  type="button"
                  class="tab-btn whitespace-nowrap rounded-full bg-gray-900 px-4 py-2 text-sm font-semibold text-white"
                  id="personal-info-tab"
                  data-tab-target="#personal-info"
                  aria-controls="personal-info"
                  aria-selected="true">
                  Información personal
                </button>

                <button
                  type="button"
                  class="tab-btn whitespace-nowrap rounded-full px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                  id="security-tab"
                  data-tab-target="#security"
                  aria-controls="security"
                  aria-selected="false">
                  Configuración de reservas
                </button>
              </div>
            </div>

            <div>

              <!-- Personal info tab -->
              <div class="tab-pane" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
                <div class="space-y-4">
                  <!-- Settings form (solo lectura) -->
                  <form novalidate>
                    <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 mb-4">

                      <div class="sm:col-span-2">
                        <label for="fn" class="mb-1 block text-sm font-medium text-gray-900">Nombre y Apellido *</label>
                        <input
                          type="text"
                          id="fn"
                          value="<?= htmlspecialchars($currentUser['username'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                          required
                          disabled
                          class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm">
                      </div>

                      <div>
                        <label for="email" class="mb-1 flex items-center text-sm font-medium text-gray-900">
                          Dirección de correo electrónico *
                        </label>
                        <input
                          type="email"
                          id="email"
                          value="<?= htmlspecialchars($currentUser['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                          required
                          disabled
                          class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm">
                      </div>

                      <div>
                        <label for="phone" class="mb-1 flex items-center text-sm font-medium text-gray-900">
                          Número de teléfono *
                        </label>
                        <input
                          type="tel"
                          id="phone"
                          value="<?= htmlspecialchars($currentUser['phone'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                          placeholder="(___) ___-____"
                          required
                          disabled
                          class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm">
                      </div>

                    </div>

                    <div class="mb-4">
                      <label for="rango" class="mb-1 block text-sm font-medium text-gray-900">Rango *</label>
                      <input
                        type="text"
                        id="rango"
                        value="<?= htmlspecialchars($currentUser['role'] ?? $currentUser['rango'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                        disabled
                        class="w-full rounded-lg border border-gray-300 bg-gray-50 px-4 py-3 text-sm text-gray-900 shadow-sm">
                    </div>
                  </form>
                </div>
              </div>

              <!-- Configuración de reservas tab -->
              <div class="tab-pane hidden" id="security" role="tabpanel" aria-labelledby="security-tab">
                <p class="mb-4 text-sm text-gray-700">
                  Su dirección de correo electrónico actual es
                  <span class="font-semibold text-gray-900">
                    <?= htmlspecialchars($currentUser['email'] ?? '', ENT_QUOTES, 'UTF-8') ?>
                  </span>
                </p>

                <div class="overflow-hidden rounded-2xl border border-gray-200 bg-white">
                  <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                      <thead class="bg-gray-50">
                        <tr>
                          <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">ID</th>
                          <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Nombre</th>
                          <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Teléfono</th>
                          <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Activo</th>
                          <th class="px-4 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-600">Acciones</th>
                        </tr>
                      </thead>

                      <tbody class="divide-y divide-gray-100 bg-white">
                        <?php if (!empty($gestores)): ?>
                          <?php foreach ($gestores as $g): ?>
                            <?php
                            $id       = (int)($g['id'] ?? $g['gestor_id'] ?? 0);
                            $nombre   = htmlspecialchars($g['nombre'] ?? '',   ENT_QUOTES, 'UTF-8');
                            $telefono = htmlspecialchars($g['telefono'] ?? '', ENT_QUOTES, 'UTF-8');
                            $activo   = !empty($g['activo']);
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
                                    <form
                                      action="<?= BASE_URL ?>dashboard/reservas/activate"
                                      method="POST"
                                      onsubmit="return confirm('¿Estás seguro de que deseas activar este gestor?');">
                                      <input type="hidden" name="id" value="<?= $id ?>">
                                      <button type="submit"
                                        class="inline-flex items-center justify-center rounded-full bg-emerald-600 px-4 py-2 text-sm font-semibold text-white hover:bg-emerald-700">
                                        Activar
                                      </button>
                                    </form>
                                  <?php endif; ?>

                                  <form
                                    action="<?= BASE_URL ?>dashboard/reservas/delete"
                                    method="POST"
                                    onsubmit="return confirm('¿Estás seguro de que deseas eliminar este gestor?');">
                                    <input type="hidden" name="id" value="<?= $id ?>">

                                    <?php if (!$activo): ?>
                                      <button type="submit"
                                        class="inline-flex items-center justify-center rounded-full bg-red-600 px-4 py-2 text-sm font-semibold text-white hover:bg-red-700">
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

      </div>
    </div>
  </main>

  <!-- Vendor scripts -->
  <script src="<?= BASE_URL ?>assets/js/glightbox.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/choices.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/nouislider.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    // Tabs Tailwind (reemplazo de nav-pills + tab-pane)
    document.addEventListener("DOMContentLoaded", () => {
      const tabButtons = document.querySelectorAll(".tab-btn");
      const panes = document.querySelectorAll(".tab-pane");

      function activate(targetId, btn) {
        panes.forEach(p => p.classList.add("hidden"));
        document.querySelector(targetId)?.classList.remove("hidden");

        tabButtons.forEach(b => {
          b.classList.remove("bg-gray-900", "text-white");
          b.classList.add("text-gray-700");
          b.setAttribute("aria-selected", "false");
        });

        btn.classList.add("bg-gray-900", "text-white");
        btn.classList.remove("text-gray-700");
        btn.setAttribute("aria-selected", "true");
      }

      tabButtons.forEach(btn => {
        btn.addEventListener("click", () => {
          const target = btn.getAttribute("data-tab-target");
          if (target) activate(target, btn);
        });
      });

      // Inicial
      const activeBtn = document.getElementById("personal-info-tab");
      if (activeBtn) activate("#personal-info", activeBtn);
    });
  </script>

</body>

</html>