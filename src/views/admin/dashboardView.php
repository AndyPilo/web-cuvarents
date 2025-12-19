<?php
include_once __DIR__ . '/../../../includes/header.php';
?>

<body>

  <main class="content-wrapper">
    <div class="mx-auto max-w-7xl px-4 pt-4 pb-5 sm:px-6 sm:pt-5 lg:px-8">
      <div class="pt-2 pb-2 sm:pt-0 sm:pb-3 md:pb-4 lg:pt-2 lg:pb-5">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
          <?php include __DIR__ . '/partials/sidebar.php'; ?>

          <!-- Account settings content -->
          <div class="lg:col-span-9">

            <div class="flex items-center justify-between pb-5">
              <h1 class="text-2xl font-semibold text-gray-900">Dashboard</h1>
            </div>

            <!-- Bloque: Mis rentas -->
            <div class="mb-4 rounded-[2rem] bg-white p-2 shadow sm:p-3 md:p-4">
              <h3 class="text-xl font-semibold text-gray-900">Mis rentas</h3>

              <div class="mt-4 flex flex-col gap-4" id="publishedSelection">
                <?php if (!empty($rentas)): ?>
                  <?php foreach ($rentas as $row): ?>
                    <?php
                    $images     = !empty($row['images']) ? explode(',', $row['images']) : [];
                    $firstImage = !empty($images[0])
                      ? BASE_URL . 'uploads/' . $images[0]
                      : BASE_URL . 'assets/img/default-img.png';

                    $rentalId       = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                    $rentalTitle    = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                    $rentalPrice    = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
                    $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                    $rentalCreated  = !empty($row['rental_created_at'])
                      ? date('d/m/Y', strtotime($row['rental_created_at']))
                      : '';
                    $rentalEdited   = !empty($row['rental_updated_at'])
                      ? date('d/m/Y', strtotime($row['rental_updated_at']))
                      : '';

                    $rentalPriceDisplay = ($rentalPrice == "1") ? "Consultar" : "$" . $rentalPrice;
                    ?>

                    <div class="w-full">
                      <article class="w-full rounded-2xl border border-gray-200 bg-white">
                        <div class="flex flex-col sm:flex-row">

                          <!-- Imagen -->
                          <div class="sm:w-4/12 md:w-3/12">
                            <a class="relative block h-44 w-full bg-gray-100 sm:h-full sm:min-h-[174px]
                              overflow-hidden rounded-t-2xl sm:rounded-l-2xl sm:rounded-tr-none sm:rounded-r-none"
                              href="#">
                              <img src="<?= $firstImage ?>"
                                class="absolute inset-0 h-full w-full object-cover"
                                alt="Imagen de <?= $rentalTitle ?>">
                            </a>
                          </div>

                          <!-- Contenido -->
                          <div class="flex-1">
                            <div class="grid grid-cols-1 gap-4 p-3 sm:grid-cols-12 sm:p-4">

                              <div class="sm:col-span-8 relative">
                                <span class="mb-2 inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-900">
                                  <?= $rentalTitle ?>
                                </span>

                                <div class="mb-2 text-lg font-semibold text-gray-900">
                                  <?= $rentalPriceDisplay ?>
                                </div>

                                <a class="block text-sm text-gray-700 no-underline hover:underline"
                                  href="#">
                                  <?= $rentalLocation ?>
                                </a>
                              </div>

                              <div class="sm:col-span-4">
                                <?php if ($rentalCreated): ?>
                                  <div class="text-xs text-gray-500">Publicada: <?= $rentalCreated ?></div>
                                <?php endif; ?>
                                <?php if ($rentalEdited): ?>
                                  <div class="mb-3 text-xs text-gray-500">Editada: <?= $rentalEdited ?></div>
                                <?php endif; ?>

                                <div class="flex items-center justify-start gap-2 mb-3">

                                  <!-- Editar (ojo: data-bs-* ya no abrirá modal sin Bootstrap) -->
                                  <button type="button"
                                    class="edit-rental-btn inline-flex items-center justify-center rounded-full border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    data-rental-id="<?= $rentalId ?>">
                                    Editar renta
                                  </button>

                                  <!-- Dropdown (Tailwind + JS) -->
                                  <div class="relative">
                                    <button type="button"
                                      class="dropdown-toggle inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50"
                                      aria-expanded="false"
                                      aria-label="Settings">
                                      <!-- Icono simple de settings (evita fi-settings de bootstrap iconpack) -->
                                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <circle cx="12" cy="5" r="2"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                        <circle cx="12" cy="19" r="2"></circle>
                                      </svg>
                                    </button>

                                    <ul class="dropdown-menu absolute right-0 z-20 mt-2 hidden w-56 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg">
                                      <li class="border-b border-gray-100">
                                        <form class="promote-rent-form" action="<?= BASE_URL ?>dashboard/rents/promoteRent" method="POST">
                                          <input type="hidden" name="rental_id" value="<?= $rentalId ?>">
                                          <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <span class="mr-2 inline-flex h-2 w-2 rounded-full bg-yellow-400"></span>
                                            Promocionar
                                          </button>
                                        </form>
                                      </li>

                                      <li class="border-b border-gray-100">
                                        <form class="hide-rent-form" action="<?= BASE_URL ?>dashboard/rents/hideRent" method="POST">
                                          <input type="hidden" name="rental_id" value="<?= $rentalId ?>">
                                          <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <span class="mr-2 inline-flex h-2 w-2 rounded-full bg-gray-400"></span>
                                            Ocultar
                                          </button>
                                        </form>
                                      </li>

                                      <li>
                                        <form class="delete-rent-form" action="<?= BASE_URL ?>dashboard/rents/deleteRent" method="POST">
                                          <input type="hidden" name="rental_id" value="<?= $rentalId ?>">
                                          <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-red-600 hover:bg-red-50">
                                            <span class="mr-2 inline-flex h-2 w-2 rounded-full bg-red-500"></span>
                                            Eliminar
                                          </button>
                                        </form>
                                      </li>
                                    </ul>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>

                        </div>
                      </article>
                    </div>

                  <?php endforeach; ?>
                <?php else: ?>
                  <p class="text-sm text-gray-600">No hay rentas disponibles.</p>
                <?php endif; ?>

                <div class="pt-2">
                  <a href="<?= BASE_URL ?>dashboard/rents"
                    class="inline-flex items-center justify-center rounded-full bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black">
                    Ver rentas
                  </a>
                </div>
              </div>
            </div>

            <!-- Bloque: Comentarios -->
            <div class="mb-4 rounded-[2rem] bg-white p-2 shadow sm:p-3 md:p-4">
              <h3 class="text-xl font-semibold text-gray-900">Comentarios</h3>

              <?php if ($ultimaRecomendacion): ?>
                <?php
                $userName           = htmlspecialchars($ultimaRecomendacion['user_name'], ENT_QUOTES, 'UTF-8');
                $userRank           = htmlspecialchars($ultimaRecomendacion['user_rank'], ENT_QUOTES, 'UTF-8');
                $recommendationText = htmlspecialchars($ultimaRecomendacion['recommendation_text'], ENT_QUOTES, 'UTF-8');
                $createdDate        = date('M d, Y', strtotime($ultimaRecomendacion['created_at']));
                ?>

                <div class="py-2">
                  <div class="mt-2 mb-3 flex items-center">
                    <div class="flex items-center pr-3">
                      <div class="bg-gradient-al h-12 w-12 shrink-0 overflow-hidden rounded-full bg-gray-200"></div>
                      <div class="ps-3">
                        <h6 class="mb-1 text-sm font-semibold text-gray-900"><?= $userName ?></h6>
                        <div class="text-xs text-gray-500"><?= $createdDate ?></div>
                      </div>
                    </div>
                  </div>

                  <p class="mb-2 text-sm text-gray-700">
                    Status:
                    <a class="ms-2 font-medium text-gray-900 hover:underline" href="#">
                      <?= $userRank ?>
                    </a>
                  </p>

                  <p class="text-sm text-gray-700"><?= $recommendationText ?></p>
                </div>
              <?php else: ?>
                <p class="text-sm text-gray-600">No hay recomendaciones disponibles.</p>
              <?php endif; ?>

              <div class="pt-2">
                <a href="<?= BASE_URL ?>dashboard/reviews"
                  class="inline-flex items-center justify-center rounded-full bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-black">
                  Ver comentarios
                </a>
              </div>
            </div>

          </div>
        </div>

      </div>
    </div>
  </main>

  <?php include __DIR__ . '/partials/rentalModal.php'; ?>

  <!-- scripts -->
  <script src="<?= BASE_URL ?>assets/js/glightbox.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/choices.min.js"></script>
  <script src="<?= BASE_URL ?>assets/js/nouislider.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script>
    function setupSweetAlert(formSelector, title, text, icon = 'warning', confirmButtonText = 'Confirmar') {
      document.querySelectorAll(formSelector).forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();
          Swal.fire({
            title,
            text,
            icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText,
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) form.submit();
          });
        });
      });
    }

    setupSweetAlert('.delete-rent-form', '¿Estás seguro?', 'La renta será eliminada permanentemente', 'warning', 'Sí, eliminar');
    setupSweetAlert('.hide-rent-form', '¿Estás seguro?', 'La renta será ocultada y no será visible públicamente', 'warning', 'Sí, ocultar');
    setupSweetAlert('.promote-rent-form', '¿Estás seguro?', 'La renta será promocionada', 'info', 'Sí, promocionar');

    // Dropdown Tailwind (reemplazo bootstrap dropdown)
    document.addEventListener("DOMContentLoaded", () => {
      const toggles = document.querySelectorAll(".dropdown-toggle");

      function closeAll() {
        document.querySelectorAll(".dropdown-menu").forEach(m => m.classList.add("hidden"));
        toggles.forEach(t => t.setAttribute("aria-expanded", "false"));
      }

      toggles.forEach(toggle => {
        toggle.addEventListener("click", (e) => {
          e.stopPropagation();
          const menu = toggle.parentElement.querySelector(".dropdown-menu");
          const isHidden = menu.classList.contains("hidden");
          closeAll();
          if (isHidden) {
            menu.classList.remove("hidden");
            toggle.setAttribute("aria-expanded", "true");
          }
        });
      });

      document.addEventListener("click", closeAll);
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") closeAll();
      });
    });
  </script>

</body>

</html>