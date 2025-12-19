<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body>

  <main class="content-wrapper">
    <div class="mx-auto max-w-7xl px-4 pt-4 pb-5 sm:px-6 sm:pt-5 lg:px-8">
      <div class="pt-2 pb-2 sm:pt-0 sm:pb-3 md:pb-4 lg:pt-2 lg:pb-5">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
          <?php include __DIR__ . '/partials/sidebar.php'; ?>

          <!-- Contenido principal -->
          <div class="lg:col-span-9">

            <div class="flex items-center justify-between pb-3">
              <h1 class="text-2xl font-semibold text-gray-900">Reseñas</h1>

              <!-- Botón para abrir la Modal (Tailwind) -->
              <button
                type="button"
                id="openAddReviewModal"
                class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-700">
                Agregar Reseña
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

            <!-- Modal Agregar Reseña (Tailwind) -->
            <div
              class="fixed inset-0 z-50 hidden overflow-y-auto"
              id="addReviewModal"
              tabindex="-1"
              aria-labelledby="addReviewModalLabel"
              aria-hidden="true"
              role="dialog"
              aria-modal="true">
              <!-- Overlay -->
              <div class="fixed inset-0 bg-black/50" data-review-overlay></div>

              <!-- Dialog -->
              <div class="relative mx-auto flex min-h-full w-full items-start justify-center px-3 py-6">
                <div class="w-full max-w-xl overflow-hidden rounded-2xl bg-white shadow-xl ring-1 ring-black/10 flex flex-col max-h-[90vh]">

                  <!-- Header -->
                  <div class="flex items-center justify-between border-b border-gray-200 px-4 py-4 sm:px-6 flex-none">
                    <h5 class="text-lg font-semibold text-gray-900" id="addReviewModalLabel">Agregar Reseña</h5>
                    <button
                      type="button"
                      class="inline-flex h-10 w-10 items-center justify-center rounded-full text-gray-600 hover:bg-gray-100 hover:text-gray-900"
                      aria-label="Cerrar"
                      data-review-close>
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
                    <form id="addReviewForm"
                      action="<?= BASE_URL ?>dashboard/reviews/store"
                      method="POST"
                      class="space-y-4">

                      <div>
                        <label for="reviewText" class="mb-1 block text-sm font-medium text-gray-900">Tu Reseña</label>
                        <textarea
                          class="min-h-[120px] w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30"
                          id="reviewText"
                          name="reviewText"
                          rows="4"
                          required></textarea>
                      </div>

                      <div>
                        <label for="userName" class="mb-1 block text-sm font-medium text-gray-900">Tu Nombre</label>
                        <input
                          type="text"
                          class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30"
                          id="userName"
                          name="userName"
                          required>
                      </div>

                      <div>
                        <label for="userRank" class="mb-1 block text-sm font-medium text-gray-900">Tu Rango</label>
                        <input
                          type="text"
                          class="w-full rounded-lg border border-gray-300 bg-white px-3 py-2 text-sm text-gray-900 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/30"
                          id="userRank"
                          name="userRank"
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

            <!-- Listado de reseñas -->
            <div class="mt-4">
              <?php if (!empty($recommendations)): ?>
                <?php foreach ($recommendations as $row): ?>
                  <?php
                  $recommendationId   = (int)$row['recommendation_id'];
                  $userName           = htmlspecialchars($row['user_name'] ?? '', ENT_QUOTES, 'UTF-8');
                  $userRank           = htmlspecialchars($row['user_rank'] ?? '', ENT_QUOTES, 'UTF-8');
                  $recommendationText = htmlspecialchars($row['recommendation_text'] ?? '', ENT_QUOTES, 'UTF-8');
                  $createdDate        = '';
                  if (!empty($row['created_at'])) {
                    $createdDate = date('M d, Y', strtotime($row['created_at']));
                  }
                  ?>

                  <div class="border-b border-gray-200 py-4">
                    <div class="mt-2 mb-3 flex items-center">
                      <div class="flex items-center pr-3">
                        <div class="bg-gradient-al h-12 w-12 shrink-0 overflow-hidden rounded-full bg-gray-200"></div>
                        <div class="ps-3">
                          <h6 class="mb-1 text-sm font-semibold text-gray-900"><?= $userName ?></h6>
                          <?php if ($createdDate): ?>
                            <div class="text-xs text-gray-500"><?= $createdDate ?></div>
                          <?php endif; ?>
                        </div>
                      </div>
                    </div>

                    <p class="mb-2 text-sm text-gray-700">
                      Status:
                      <span class="ms-2 font-medium text-gray-900">
                        <?= $userRank ?>
                      </span>
                    </p>

                    <p class="text-sm text-gray-700"><?= $recommendationText ?></p>

                    <form
                      class="delete-review-form inline-block mt-3"
                      action="<?= BASE_URL ?>dashboard/reviews/delete"
                      method="POST">
                      <input type="hidden" name="id" value="<?= $recommendationId ?>">
                      <button type="submit"
                        class="inline-flex items-center justify-center rounded-full bg-gray-900 px-4 py-2 text-sm font-semibold text-white hover:bg-black">
                        Eliminar
                      </button>
                    </form>
                  </div>

                <?php endforeach; ?>
              <?php else: ?>
                <p class="text-sm text-gray-600">No hay recomendaciones disponibles.</p>
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
    // Modal Tailwind (Agregar Reseña)
    document.addEventListener('DOMContentLoaded', function() {
      const modal = document.getElementById('addReviewModal');
      const overlay = modal?.querySelector('[data-review-overlay]');
      const closeBtn = modal?.querySelector('[data-review-close]');
      const openBtn = document.getElementById('openAddReviewModal');

      function openModal() {
        if (!modal) return;
        modal.classList.remove('hidden');
        modal.setAttribute('aria-hidden', 'false');
        document.documentElement.classList.add('overflow-hidden');

        setTimeout(() => {
          const first = modal.querySelector('textarea, input, select, button');
          first?.focus?.();
        }, 0);
      }

      function closeModal() {
        if (!modal) return;
        modal.classList.add('hidden');
        modal.setAttribute('aria-hidden', 'true');
        document.documentElement.classList.remove('overflow-hidden');

        // opcional: reset form al cerrar
        const form = document.getElementById('addReviewForm');
        form?.reset?.();
      }

      openBtn?.addEventListener('click', openModal);
      overlay?.addEventListener('click', closeModal);
      closeBtn?.addEventListener('click', closeModal);

      document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape' && modal && !modal.classList.contains('hidden')) closeModal();
      });
    });

    // Confirmación SweetAlert para eliminar reseña (igual)
    document.querySelectorAll('.delete-review-form').forEach(function(form) {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        Swal.fire({
          title: '¿Estás seguro?',
          text: 'La reseña será eliminada permanentemente.',
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
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