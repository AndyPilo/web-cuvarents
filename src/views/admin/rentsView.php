<?php include_once __DIR__ . '/../../../includes/header.php'; ?>

<body>

  <main class="content-wrapper">
    <div class="mx-auto max-w-7xl px-4 pt-4 pb-5 sm:px-6 sm:pt-5 lg:px-8">
      <div class="pt-2 pb-2 sm:pt-0 sm:pb-3 md:pb-4 lg:pt-2 lg:pb-5">

        <div class="grid grid-cols-1 gap-6 lg:grid-cols-12">
          <?php include __DIR__ . '/partials/sidebar.php'; ?>

          <div class="lg:col-span-9">

            <div class="flex items-center justify-between pb-5">
              <h1 class="text-2xl font-semibold text-gray-900">Gestión de Rentas</h1>

              <button type="button"
                id="aggrent"
                class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white hover:bg-sky-700">
                Agregar Renta
              </button>
            </div>

            <form method="GET" action="<?= BASE_URL ?>dashboard/rents" class="mb-4">
              <div class="flex flex-col sm:flex-row gap-2 sm:items-center">
                <div class="relative flex-1">
                  <input
                    type="text"
                    name="q"
                    value="<?= htmlspecialchars($_GET['q'] ?? '', ENT_QUOTES, 'UTF-8') ?>"
                    placeholder="Buscar por título, ID, provincia o municipio..."
                    class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 placeholder-gray-400 focus:border-sky-500 focus:ring-1 focus:ring-sky-500/20" />
                </div>

                <button
                  type="submit"
                  class="inline-flex items-center justify-center rounded-xl bg-gray-900 px-5 py-3 text-sm font-semibold text-white hover:bg-gray-800">
                  Buscar
                </button>

                <?php if (!empty($_GET['q'])): ?>
                  <a
                    href="<?= BASE_URL ?>dashboard/rents"
                    class="inline-flex items-center justify-center rounded-xl border border-gray-300 bg-white px-5 py-3 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                    Limpiar
                  </a>
                <?php endif; ?>
              </div>
            </form>

            <div class="mb-2 overflow-x-auto">
              <div class="inline-flex gap-2 pb-2">
                <button type="button"
                  class="tab-btn whitespace-nowrap rounded-full px-4 py-2 text-sm font-semibold bg-gray-900 text-white"
                  id="published-tab"
                  data-tab-target="#published"
                  aria-controls="published"
                  aria-selected="true">
                  Publicadas
                </button>

                <button type="button"
                  class="tab-btn whitespace-nowrap rounded-full px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                  id="drafts-tab"
                  data-tab-target="#drafts"
                  aria-controls="drafts"
                  aria-selected="false">
                  Ocultas
                </button>

                <button type="button"
                  class="tab-btn whitespace-nowrap rounded-full px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
                  id="archived-tab"
                  data-tab-target="#archived"
                  aria-controls="archived"
                  aria-selected="false">
                  Promocionadas
                </button>
              </div>
            </div>

            <div class="mt-5">

              <div class="tab-pane" id="published" role="tabpanel" aria-labelledby="published-tab">
                <div class="flex flex-col gap-4" id="publishedSelection">

                  <?php if (!empty($rentasVisibles)): ?>
                    <?php foreach ($rentasVisibles as $row): ?>
                      <?php
                      $images     = !empty($row['images']) ? explode(',', $row['images']) : [];
                      $firstImage = !empty($images[0])
                        ? BASE_URL . 'uploads/' . $images[0]
                        : BASE_URL . 'assets/img/default-img.png';

                      $rentalId    = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                      $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                      $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');

                      $rentalPriceDisplay = ($rentalPrice == "1") ? "Consultar" : "$" . $rentalPrice;

                      $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                      $rentalCreated  = date('d/m/Y', strtotime($row['rental_created_at']));
                      $rentalEdited   = date('d/m/Y', strtotime($row['rental_updated_at']));
                      ?>

                      <article class="w-full rounded-2xl border border-gray-200 bg-white">
                        <div class="flex flex-col sm:flex-row">

                          <div class="sm:w-4/12 md:w-3/12">
                            <a class="relative block h-44 w-full bg-gray-100 sm:h-full sm:min-h-[174px]
                                    overflow-hidden rounded-t-2xl sm:rounded-l-2xl sm:rounded-tr-none sm:rounded-r-none"
                              href="<?= BASE_URL ?>dashboard/single/<?= $rentalId ?>">
                              <img src="<?= $firstImage ?>"
                                class="absolute inset-0 h-full w-full object-cover"
                                alt="Imagen de <?= $rentalTitle ?>">
                            </a>
                          </div>

                          <div class="flex-1">
                            <div class="grid grid-cols-1 gap-4 p-3 sm:grid-cols-12 sm:p-4">

                              <div class="sm:col-span-8 relative">
                                <span class="mb-2 inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-900">
                                  <?= $rentalTitle ?>
                                </span>

                                <div class="mb-2 text-lg font-semibold text-gray-900">
                                  <?= $rentalPriceDisplay ?>
                                </div>

                                <a class="block text-sm text-gray-700 hover:underline"
                                  href="<?= BASE_URL ?>dashboard/single/<?= $rentalId ?>">
                                  <?= $rentalLocation ?>
                                </a>
                              </div>

                              <div class="sm:col-span-4">
                                <div class="text-xs text-gray-500">Publicada: <?= $rentalCreated ?></div>
                                <div class="mb-3 text-xs text-gray-500">Editada: <?= $rentalEdited ?></div>

                                <div class="flex items-center justify-start gap-2 mb-3">
                                  <button type="button"
                                    class="edit-rental-btn inline-flex items-center justify-center rounded-full border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    data-rental-id="<?= $rentalId ?>">
                                    Editar renta
                                  </button>

                                  <div class="relative">
                                    <button type="button"
                                      class="dropdown-toggle inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50"
                                      aria-expanded="false"
                                      aria-label="Settings">
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

                    <?php endforeach; ?>

                    <?php if ($totalPages > 1): ?>
                      <?php
                      $range = 5;
                      $start = max(1, $page - $range);
                      $end   = min($totalPages, $page + $range);
                      $qParam = !empty($_GET['q']) ? '&q=' . urlencode($_GET['q']) : '';
                      ?>
                      <nav class="pt-3 mt-3" aria-label="Listings pagination">
                        <ul class="flex flex-wrap items-center justify-center gap-2">
                          <?php if ($page > 1): ?>
                            <li>
                              <a class="inline-flex items-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                href="<?= BASE_URL ?>dashboard/rents?page=<?= $page - 1 ?><?= $qParam ?>">
                                Anterior
                              </a>
                            </li>
                          <?php endif; ?>

                          <?php for ($i = $start; $i <= $end; $i++): ?>
                            <?php if ($i == $page): ?>
                              <li>
                                <span class="inline-flex items-center rounded-full bg-gray-900 px-4 py-2 text-sm font-semibold text-white">
                                  <?= $i ?>
                                </span>
                              </li>
                            <?php else: ?>
                              <li>
                                <a class="inline-flex items-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                  href="<?= BASE_URL ?>dashboard/rents?page=<?= $i ?><?= $qParam ?>">
                                  <?= $i ?>
                                </a>
                              </li>
                            <?php endif; ?>
                          <?php endfor; ?>

                          <?php if ($page < $totalPages): ?>
                            <li>
                              <a class="inline-flex items-center rounded-full border border-gray-300 bg-white px-4 py-2 text-sm text-gray-700 hover:bg-gray-50"
                                href="<?= BASE_URL ?>dashboard/rents?page=<?= $page + 1 ?><?= $qParam ?>">
                                Siguiente
                              </a>
                            </li>
                          <?php endif; ?>
                        </ul>
                      </nav>
                    <?php endif; ?>

                  <?php else: ?>
                    <p class="text-sm text-gray-600">No hay rentas disponibles.</p>
                  <?php endif; ?>
                </div>
              </div>

              <div class="tab-pane hidden" id="drafts" role="tabpanel" aria-labelledby="drafts-tab">
                <div class="flex flex-col gap-4" id="draftsSelection">
                  <?php if (!empty($rentasOcultas)): ?>
                    <?php foreach ($rentasOcultas as $row): ?>
                      <?php
                      $images     = !empty($row['images']) ? explode(',', $row['images']) : [];
                      $firstImage = !empty($images[0])
                        ? BASE_URL . 'uploads/' . $images[0]
                        : BASE_URL . 'assets/img/default-img.png';

                      $rentalId    = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                      $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                      $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
                      $rentalPriceDisplay = ($rentalPrice == "1") ? "Consultar" : "$" . $rentalPrice;
                      $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                      $rentalCreated  = date('d/m/Y', strtotime($row['rental_created_at']));
                      $rentalEdited   = date('d/m/Y', strtotime($row['rental_updated_at']));
                      ?>

                      <article class="w-full rounded-2xl border border-gray-200 bg-white">
                        <div class="flex flex-col sm:flex-row">
                          <div class="sm:w-4/12 md:w-3/12">
                            <a class="relative block h-44 w-full bg-gray-100 sm:h-full sm:min-h-[174px]
          overflow-hidden rounded-t-2xl sm:rounded-l-2xl sm:rounded-tr-none sm:rounded-r-none"
                              href="<?= BASE_URL ?>dashboard/single/<?= $rentalId ?>">
                              <img src="<?= $firstImage ?>"
                                class="absolute inset-0 h-full w-full object-cover"
                                alt="Imagen de <?= $rentalTitle ?>">
                            </a>
                          </div>

                          <div class="flex-1">
                            <div class="grid grid-cols-1 gap-4 p-3 sm:grid-cols-12 sm:p-4">
                              <div class="sm:col-span-8 relative">
                                <span class="mb-2 inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-900">
                                  <?= $rentalTitle ?>
                                </span>
                                <div class="mb-2 text-lg font-semibold text-gray-900"><?= $rentalPriceDisplay ?></div>
                                <a class="block text-sm text-gray-700 hover:underline"
                                  href="<?= BASE_URL ?>dashboard/single/<?= $rentalId ?>">
                                  <?= $rentalLocation ?>
                                </a>
                              </div>

                              <div class="sm:col-span-4">
                                <div class="text-xs text-gray-500">Publicada: <?= $rentalCreated ?></div>
                                <div class="mb-3 text-xs text-gray-500">Editada: <?= $rentalEdited ?></div>

                                <div class="flex items-center justify-start gap-2 mb-3">
                                  <button type="button"
                                    class="edit-rental-btn inline-flex items-center justify-center rounded-full border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    data-rental-id="<?= $rentalId ?>">
                                    Editar renta
                                  </button>

                                  <div class="relative">
                                    <button type="button"
                                      class="dropdown-toggle inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50"
                                      aria-expanded="false"
                                      aria-label="Settings">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <circle cx="12" cy="5" r="2"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                        <circle cx="12" cy="19" r="2"></circle>
                                      </svg>
                                    </button>

                                    <ul class="dropdown-menu absolute right-0 z-20 mt-2 hidden w-56 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg">
                                      <li class="border-b border-gray-100">
                                        <form class="unhide-rent-form" action="<?= BASE_URL ?>dashboard/rents/unhideRent" method="POST">
                                          <input type="hidden" name="rental_id" value="<?= $rentalId ?>">
                                          <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <span class="mr-2 inline-flex h-2 w-2 rounded-full bg-emerald-500"></span>
                                            Mostrar nuevamente
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

                    <?php endforeach; ?>
                  <?php else: ?>
                    <p class="text-sm text-gray-600">No hay rentas ocultas.</p>
                  <?php endif; ?>
                </div>
              </div>

              <div class="tab-pane hidden" id="archived" role="tabpanel" aria-labelledby="archived-tab">
                <div class="flex flex-col gap-4" id="archivedSelection">
                  <?php if (!empty($rentasPromocionadas)): ?>
                    <?php foreach ($rentasPromocionadas as $row): ?>
                      <?php
                      $images     = !empty($row['images']) ? explode(',', $row['images']) : [];
                      $firstImage = !empty($images[0])
                        ? BASE_URL . 'uploads/' . $images[0]
                        : BASE_URL . 'assets/img/default-img.png';

                      $rentalId    = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                      $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                      $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
                      $rentalPriceDisplay = ($rentalPrice == "1") ? "Consultar" : "$" . $rentalPrice;
                      $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                      $rentalCreated  = date('d/m/Y', strtotime($row['rental_created_at']));
                      $rentalEdited   = date('d/m/Y', strtotime($row['rental_updated_at']));
                      ?>

                      <article class="w-full rounded-2xl border border-gray-200 bg-white">
                        <div class="flex flex-col sm:flex-row">
                          <div class="sm:w-4/12 md:w-3/12">
                            <a class="relative block h-44 w-full bg-gray-100 sm:h-full sm:min-h-[174px]
          overflow-hidden rounded-t-2xl sm:rounded-l-2xl sm:rounded-tr-none sm:rounded-r-none"
                              href="<?= BASE_URL ?>dashboard/single/<?= $rentalId ?>">
                              <img src="<?= $firstImage ?>"
                                class="absolute inset-0 h-full w-full object-cover"
                                alt="Imagen de <?= $rentalTitle ?>">
                            </a>
                          </div>

                          <div class="flex-1">
                            <div class="grid grid-cols-1 gap-4 p-3 sm:grid-cols-12 sm:p-4">
                              <div class="sm:col-span-8 relative">
                                <span class="mb-2 inline-flex items-center rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-900">
                                  <?= $rentalTitle ?>
                                </span>
                                <div class="mb-2 text-lg font-semibold text-gray-900"><?= $rentalPriceDisplay ?></div>
                                <a class="block text-sm text-gray-700 hover:underline"
                                  href="<?= BASE_URL ?>dashboard/single/<?= $rentalId ?>">
                                  <?= $rentalLocation ?>
                                </a>
                              </div>

                              <div class="sm:col-span-4">
                                <div class="text-xs text-gray-500">Publicada: <?= $rentalCreated ?></div>
                                <div class="mb-3 text-xs text-gray-500">Editada: <?= $rentalEdited ?></div>

                                <div class="flex items-center justify-start gap-2 mb-3">
                                  <button type="button"
                                    class="edit-rental-btn inline-flex items-center justify-center rounded-full border border-gray-300 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    data-rental-id="<?= $rentalId ?>">
                                    Editar renta
                                  </button>

                                  <div class="relative">
                                    <button type="button"
                                      class="dropdown-toggle inline-flex h-10 w-10 items-center justify-center rounded-full border border-gray-300 text-gray-700 hover:bg-gray-50"
                                      aria-expanded="false"
                                      aria-label="Settings">
                                      <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                        viewBox="0 0 24 24" fill="currentColor" aria-hidden="true">
                                        <circle cx="12" cy="5" r="2"></circle>
                                        <circle cx="12" cy="12" r="2"></circle>
                                        <circle cx="12" cy="19" r="2"></circle>
                                      </svg>
                                    </button>

                                    <ul class="dropdown-menu absolute right-0 z-20 mt-2 hidden w-56 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-lg">
                                      <li class="border-b border-gray-100">
                                        <form class="unpromote-rent-form" action="<?= BASE_URL ?>dashboard/rents/unpromoteRent" method="POST">
                                          <input type="hidden" name="rental_id" value="<?= $rentalId ?>">
                                          <button type="submit" class="flex w-full items-center px-4 py-3 text-sm text-gray-700 hover:bg-gray-50">
                                            <span class="mr-2 inline-flex h-2 w-2 rounded-full bg-sky-500"></span>
                                            Quitar promoción
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

                    <?php endforeach; ?>
                  <?php else: ?>
                    <p class="text-sm text-gray-600">No hay rentas promocionadas.</p>
                  <?php endif; ?>
                </div>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </main>

  <?php include __DIR__ . '/partials/rentalModal.php'; ?>

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
    setupSweetAlert('.unhide-rent-form', '¿Estás seguro?', 'La renta volverá a estar visible', 'info', 'Sí, mostrar');
    setupSweetAlert('.unpromote-rent-form', '¿Estás seguro?', 'La renta dejará de estar promocionada', 'info', 'Sí, quitar promoción');

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

      const activeBtn = document.getElementById("published-tab");
      if (activeBtn) activate("#published", activeBtn);
    });

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