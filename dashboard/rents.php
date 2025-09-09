<?php
session_start();

if (!isset($_SESSION['account_id']) || $_SESSION['account_rango'] != 99) {
  header("Location: ../auth/login.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Meta tags -->
  <title>Dashboard</title>

  <?php
  // Detectar si está en localhost o producción
  $basePath = '/dashboard/';
  if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost') {
    $basePath = '/web-cuvarents/dashboard/';
  }
  ?>

  <base href="<?php echo $basePath; ?>">

  <meta name="author" content="Uixsoftware">
  <meta name="keywords" content="desarrollo web, agencia, empresa, diseño web, SEO, wordPress, habana, cuba, perzonalización, como crear web, tienda online">
  <meta name="description" content="Servicios de desarrollo web y marketing digital en Cuba. Ofrecemos soluciones personalizadas y de calidad para potenciar tu negocio en internet - Uixsoftware">
  <meta property="og:description" content="Servicios de desarrollo web y marketing digital en Cuba. Ofrecemos soluciones personalizadas y de calidad para potenciar tu negocio en internet.">
  <meta property="og:url" content="https://www.uixsoftware.com/">
  <meta property="og:image" content="https://www.uixsoftware.com/assets/img/logos/logo_uixsoftware.svg">
  <meta property="og:type" content="website">
  <meta property="og:title" content="Uixsoftware | Servicios de Desarrollo Web en Cuba">
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="Uixsoftware | Servicios de Desarrollo Web en Cuba">
  <meta name="twitter:description" content="Servicios de desarrollo web y marketing digital en Cuba. Ofrecemos soluciones personalizadas y de calidad para potenciar tu negocio en internet.">
  <meta name="twitter:image" content="https://www.uixsoftware.com/assets/img/logos/logo_uixsoftware.svg">
  <meta name="contact" content="soporte@uixsoftware.com">
  <meta name="copyright" content="Copyright (c) 2024. Uixsoftware. All Rights Reserved.">
  <meta name="DC.title" content="Uixsoftware: Líderes en Desarrollo Web en Cuba">
  <meta name="geo.placename" content="CUBA">
  <meta name="geo.region" content="CU">
  <meta name="robots" content="noindex, nofollow">

  <link rel="icon" href="/uixsoftware/assets/img/favicon-32x32.png" type="image/png">

  <!-- Style -->
  <link rel="stylesheet" href="style/file-upload.css">

  <!-- Sweet Alert -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.css">

  <!-- Theme switcher (color modes) -->
  <script src="../uixsoftware/assets/js/theme-switcher.js"></script>

  <!-- Preloaded local web font (Inter) -->
  <link href="../uixsoftware/assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin="">

  <!-- Font icons -->
  <link rel="stylesheet" href="../uixsoftware/assets/css/finder-icons.min.css">
  <link href="../uixsoftware/assets/fonts/finder-icons.woff2" as="font" type="font/woff2" crossorigin="">

  <!-- Vendor styles -->
  <link rel="stylesheet" href="../uixsoftware/assets/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="../uixsoftware/assets/css/glightbox.min.css">
  <link rel="stylesheet" href="../uixsoftware/assets/css/choices.min.css">
  <link rel="stylesheet" href="../uixsoftware/assets/css/nouislider.min.css">
  <!-- Bootstrap + Theme styles -->
  <link rel="preload" href="../uixsoftware/assets/css/theme.min.css" as="style">

  <link rel="stylesheet" href="../uixsoftware/assets/css/theme.min.css" id="theme-styles">

  <!-- Customizer -->
  <script src="../uixsoftware/assets/js/customizer.min.js"></script>

</head>

<!-- Body -->

<body>

  <main class="content-wrapper">
    <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
      <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">

        <?php include "sidebar.php" ?>

        <!-- Account settings content -->
        <div class="col-lg-9">
          <div class="d-flex justify-content-between pb-5">

            <h1 class="h2 mb-0">Gestión de Rentas</h1>

            <!-- Botón para abrir la Modal -->
            <button type="button" id="aggrent" class="btn btn-info d-flex" data-toggle="modal" data-target="#addRentalModal">
              Agregar Renta
            </button>
          </div>


          <!-- Nav pills -->
          <div class="nav overflow-x-auto mb-2">
            <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
              <li class="nav-item me-1" role="presentation">
                <button type="button" class="nav-link text-nowrap active" id="published-tab" data-bs-toggle="pill" data-bs-target="#published" role="tab" aria-controls="published" aria-selected="true">
                  Publicadas
                </button>
              </li>
              <li class="nav-item me-1" role="presentation">
                <button type="button" class="nav-link text-nowrap" id="drafts-tab" data-bs-toggle="pill" data-bs-target="#drafts" role="tab" aria-controls="drafts" aria-selected="false" tabindex="-1">
                  Ocultas
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link text-nowrap" id="archived-tab" data-bs-toggle="pill" data-bs-target="#archived" role="tab" aria-controls="archived" aria-selected="false" tabindex="-1">
                  Promocionadas
                </button>
              </li>
            </ul>
          </div>

          <div class="tab-content mt-5">

            <!-- Published tab -->
            <div class="tab-pane fade show active" id="published" role="tabpanel" aria-labelledby="published-tab">


              <!-- Published listings -->
              <div class="row gy-3  gap-4" id="publishedSelection">


                <?php
                // Conexión a la base de datos (asume que $conn ya está definido)

                // Obtener el número de página desde la URL amigable
                $page = 1;
                if (isset($_GET['page']) && is_numeric($_GET['page'])) {
                  $page = (int)$_GET['page'];
                }
                $itemsPerPage = 6;
                $offset = ($page - 1) * $itemsPerPage;

                // Obtener total de rentas para la paginación
                $sqlTotal = "SELECT COUNT(DISTINCT Rentals.rental_id) AS total 
             FROM Rentals 
             LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
             WHERE Rentals.is_hidden = FALSE";
                $resultTotal = $conn->query($sqlTotal);
                $rowTotal = $resultTotal->fetch_assoc();
                $totalRentals = $rowTotal['total'];
                $totalPages = ceil($totalRentals / $itemsPerPage);

                // Obtener rentas con paginación
                $sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
         FROM Rentals
         LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
         WHERE Rentals.is_hidden = FALSE
         GROUP BY Rentals.rental_id
         ORDER BY Rentals.rental_id DESC
         LIMIT ? OFFSET ?";
                $stmt = $conn->prepare($sql3);
                $stmt->bind_param("ii", $itemsPerPage, $offset);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $images = !empty($row['images']) ? explode(',', $row['images']) : [];
                    $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : '../uixsoftware/assets/img/default-img.png';
                    $rentalId = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                    $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                    $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');

                    // Si el precio es 1, mostrar "Consultar" en vez de "1$"
                    if ($rentalPrice == "1") {
                      $rentalPriceDisplay = "Consultar";
                    } else {
                      $rentalPriceDisplay = "$" . $rentalPrice;
                    }


                    $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                    $rentalCreated = date('d/m/Y', strtotime($row['rental_created_at']));
                    $rentalEdited = date('d/m/Y', strtotime($row['rental_updated_at']));

                    echo "
        <div class=\"col-12 d-sm-flex align-items-center\">
            <article class=\"card w-100\">
                <div class=\"d-sm-none\"></div>
                <div class=\"row g-0\">
                    <div class=\"col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2\">
                        <a class=\"position-relative d-flex h-100 bg-body-tertiary\"  href=\"./single/$rentalId\" style=\"min-height: 174px\">
                            <img src=\"$firstImage\" class=\"position-absolute top-0 start-0 w-100 h-100 object-fit-cover\" alt=\"Imagen de $rentalTitle\">
                            <div class=\"ratio d-none d-sm-block\" style=\"--fn-aspect-ratio: calc(180 / 240 * 100%)\"></div>
                            <div class=\"ratio ratio-16x9 d-sm-none\"></div>
                        </a>
                    </div>
                    <div class=\"col-sm-8 col-md-9 align-self-center\">
                        <div class=\"card-body row p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0\">
                            <div class=\"col-12 col-md-8 position-relative pe-3\">
                                <span class=\"badge text-body-emphasis bg-body-secondary mb-2\">$rentalTitle</span>
                                <div class=\"h5 mb-2\"> $rentalPriceDisplay</div>
                                <a class=\"stretched-link d-block fs-sm text-body text-decoration-none mb-2\" href=\"./single/$rentalId\">$rentalLocation</a>
                            </div>
                            <div class=\"col-12 col-md-4\">
                                <div class=\"fs-xs text-body-secondary\">Publicada: $rentalCreated</div>
                                <div class=\"fs-xs text-body-secondary mb-3\">Editada: $rentalEdited</div>
                                <div class=\"d-flex justify-content-start gap-2 mb-3\">
                                    <button type=\"button\" class=\"btn btn-outline-secondary edit-rental-btn\" data-rental-id=\"$rentalId\" data-toggle=\"modal\" data-target=\"#addRentalModal\">Editar renta</button>
                                    <div class=\"dropdown\">
                                        <button type=\"button\" class=\"btn btn-icon btn-outline-secondary\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" aria-label=\"Settings\">
                                            <i class=\"fi-settings fs-base\"></i>
                                        </button>
                                        <ul class=\"dropdown-menu dropdown-menu-end\">
                                            <li>
                                                <form class=\"promote-rent-form\" action=\"php-promote-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                        <button type=\"submit\" class=\"dropdown-item\">
                                                            <i class=\"fi-zap fs-base opacity-75 me-2\"></i>Promocionar
                                                        </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class=\"hide-rent-form\" action=\"php-hide-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                    <button type=\"submit\" class=\"dropdown-item\">
                                                        <i class=\"fi-archive opacity-75 me-2\"></i>Ocultar
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class=\"delete-rent-form\" action=\"php-delete-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                    <button type=\"submit\" class=\"dropdown-item text-danger\">
                                                        <i class=\"fi-trash opacity-75 me-2\"></i>Eliminar
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
        </div>";
                  }

                  $baseUrl = $basePath . 'rents/page';

                  echo '<nav class="pt-3 mt-3" aria-label="Listings pagination">
<ul class="pagination pagination-lg justify-content-center">';

                  // Botón "Anterior"
                  if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '/' . ($page - 1) . '">Anterior</a></li>';
                  }

                  // Rango de páginas a mostrar
                  $range = 5; // Número de páginas a mostrar antes y después de la actual
                  $start = max(1, $page - $range);
                  $end = min($totalPages, $page + $range);

                  // Mostrar el rango de páginas
                  for ($i = $start; $i <= $end; $i++) {
                    if ($i == $page) {
                      echo '<li class="page-item active" aria-current="page">
            <span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span>
          </li>';
                    } else {
                      echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '/' . $i . '">' . $i . '</a></li>';
                    }
                  }

                  // Botón "Siguiente"
                  if ($page < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '/' . ($page + 1) . '">Siguiente</a></li>';
                  }

                  echo '</ul></nav>';
                } else {
                  echo "<p>No hay rentas disponibles.</p>";
                }

                $stmt->close();
                ?>





              </div>
            </div>



            <!-- Drafts tab -->
            <div class="tab-pane fade" id="drafts" role="tabpanel" aria-labelledby="drafts-tab">



              <!-- Drafts listings -->
              <div class="row gy-4 gap-4" id="draftsSelection">

                <?php

                // Obtener las rentas de la base de datos (excluyendo las ocultas)
                $sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
        FROM Rentals
        LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
        WHERE Rentals.is_hidden = TRUE
        GROUP BY Rentals.rental_id";
                $result = $conn->query($sql3);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $images = !empty($row['images']) ? explode(',', $row['images']) : [];
                    $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : '../uixsoftware/assets/img/default-img.png';
                    $rentalId = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                    $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                    $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');

                    // Si el precio es 1, mostrar "Consultar" en vez de "1$"
                    if ($rentalPrice == "1") {
                      $rentalPriceDisplay = "Consultar";
                    } else {
                      $rentalPriceDisplay = "$" . $rentalPrice;
                    }


                    $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                    $rentalCreated = date('d/m/Y', strtotime($row['rental_created_at']));
                    $rentalEdited = date('d/m/Y', strtotime($row['rental_updated_at']));

                    echo "
        <div class=\"col-12 d-sm-flex align-items-center\">
         <article class=\"card w-100\">
                <div class=\"d-sm-none\"  ></div>
                <div class=\"row g-0\">
                    <div class=\"col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2\">
                        <a class=\"position-relative d-flex h-100 bg-body-tertiary\" href=\"./single/$rentalId\" style=\"min-height: 174px\">
                            <img src=\"$firstImage\" class=\"position-absolute top-0 start-0 w-100 h-100 object-fit-cover\" alt=\"Image\">
                            <div class=\"ratio d-none d-sm-block\" style=\"--fn-aspect-ratio: calc(180 / 240 * 100%)\"></div>
                            <div class=\"ratio ratio-16x9 d-sm-none\"></div>
                        </a>
                    </div>
                    <div class=\"col-sm-8 col-md-9 align-self-center\">
                        <div class=\"card-body row p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0\">
                            <div class=\"col-12 col-md-8 position-relative pe-3\">
                                <span class=\"badge text-body-emphasis bg-body-secondary mb-2\">$rentalTitle</span>
                                <div class=\"h5 mb-2\"> $rentalPriceDisplay</div>
                                <a class=\"stretched-link d-block fs-sm text-body text-decoration-none mb-2\" href=\"./single/$rentalId\">$rentalLocation</a>
                            </div>
                            <div class=\"col-12 col-md-4\">
                                <div class=\"fs-xs text-body-secondary\">Publicada: $rentalCreated</div>
                                <div class=\"fs-xs text-body-secondary mb-3\">Editada: $rentalEdited</div>
                                <div class=\"d-flex justify-content-start gap-2 mb-3\">
                                    <button type=\"button\" class=\"btn btn-outline-secondary edit-rental-btn\" data-rental-id=\"$rentalId\" data-toggle=\"modal\" data-target=\"#addRentalModal\">Editar renta</button>
                                    <div class=\"dropdown\">
                                        <button type=\"button\" class=\"btn btn-icon btn-outline-secondary\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" aria-label=\"Settings\">
                                            <i class=\"fi-settings fs-base\"></i>
                                        </button>
                                        <ul class=\"dropdown-menu dropdown-menu-end\">
                                            <li><button type=\"button\" class=\"dropdown-item edit-rental-btn\" data-rental-id=\"$rentalId\" data-toggle=\"modal\" data-target=\"#addRentalModal\"><i class=\"fi-edit fs-base opacity-75 me-2\"></i>Editar renta</button></li>
                                            
                                            <li>
                                                <form class=\"unhide-rent-form\" action=\"php-deshiden-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                    <button type=\"submit\" class=\"dropdown-item\">
                                                        <i class=\"fi-archive opacity-75 me-2\"></i>Mostrar nuevamente
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class=\"delete-rent-form\" action=\"php-delete-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                    <button type=\"submit\" class=\"dropdown-item text-danger\">
                                                        <i class=\"fi-trash opacity-75 me-2\"></i>Eliminar
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
        </div>";
                  }
                } else {
                  echo "<p>No hay rentas ocultas.</p>";
                }
                ?>




              </div>
            </div>


            <!-- Archived tab -->
            <div class="tab-pane fade" id="archived" role="tabpanel" aria-labelledby="archived-tab">


              <!-- Drafts listings -->
              <div class="row gy-5 gap-4" id="draftsSelection">

                <?php

                // Obtener las rentas de la base de datos (excluyendo las ocultas)
                $sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
FROM Rentals
LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
WHERE Rentals.is_promoted = TRUE
GROUP BY Rentals.rental_id";
                $result = $conn->query($sql3);

                if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    $images = !empty($row['images']) ? explode(',', $row['images']) : [];
                    $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : '../uixsoftware/assets/img/default-img.png';
                    $rentalId = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
                    $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                    $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');

                    // Si el precio es 1, mostrar "Consultar" en vez de "1$"
                    if ($rentalPrice == "1") {
                      $rentalPriceDisplay = "Consultar";
                    } else {
                      $rentalPriceDisplay = "$" . $rentalPrice;
                    }


                    $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                    $rentalCreated = date('d/m/Y', strtotime($row['rental_created_at']));
                    $rentalEdited = date('d/m/Y', strtotime($row['rental_updated_at']));

                    echo "
<div class=\"col-12 d-sm-flex align-items-center\"> <article class=\"card w-100\">
                <div class=\"d-sm-none\"  ></div>
                <div class=\"row g-0\">
                    <div class=\"col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2\">
                        <a class=\"position-relative d-flex h-100 bg-body-tertiary\" href=\"./single/$rentalId\" style=\"min-height: 174px\">
                            <img src=\"$firstImage\" class=\"position-absolute top-0 start-0 w-100 h-100 object-fit-cover\" alt=\"Image\">
                            <div class=\"ratio d-none d-sm-block\" style=\"--fn-aspect-ratio: calc(180 / 240 * 100%)\"></div>
                            <div class=\"ratio ratio-16x9 d-sm-none\"></div>
                        </a>
                    </div>
                    <div class=\"col-sm-8 col-md-9 align-self-center\">
                        <div class=\"card-body row p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0\">
                            <div class=\"col-12 col-md-8 position-relative pe-3\">
                                <span class=\"badge text-body-emphasis bg-body-secondary mb-2\">$rentalTitle</span>
                                <div class=\"h5 mb-2\"> $rentalPriceDisplay</div>
                                <a class=\"stretched-link d-block fs-sm text-body text-decoration-none mb-2\" href=\"./single/$rentalId\">$rentalLocation</a>
                            </div>
                            <div class=\"col-12 col-md-4\">
                                <div class=\"fs-xs text-body-secondary\">Publicada: $rentalCreated</div>
                                <div class=\"fs-xs text-body-secondary mb-3\">Editada: $rentalEdited</div>
                                <div class=\"d-flex justify-content-start gap-2 mb-3\">
                                    <button type=\"button\" class=\"btn btn-outline-secondary edit-rental-btn\" data-rental-id=\"$rentalId\" data-toggle=\"modal\" data-target=\"#addRentalModal\">Editar renta</button>
                                    <div class=\"dropdown\">
                                        <button type=\"button\" class=\"btn btn-icon btn-outline-secondary\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\" aria-label=\"Settings\">
                                            <i class=\"fi-settings fs-base\"></i>
                                        </button>
                                        <ul class=\"dropdown-menu dropdown-menu-end\">
                                            <li><button type=\"button\" class=\"dropdown-item edit-rental-btn\" data-rental-id=\"$rentalId\" data-toggle=\"modal\" data-target=\"#addRentalModal\"><i class=\"fi-edit fs-base opacity-75 me-2\"></i>Editar renta</button></li>
                                            <li>
                                                 <form class=\"promote-rent-form\" action=\"php-despromote-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                        <button type=\"submit\" class=\"dropdown-item\">
                                                            <i class=\"fi-zap fs-base opacity-75 me-2\"></i>Quitar promoción
                                                        </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class=\"hide-rent-form\" action=\"php-hide-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                    <button type=\"submit\" class=\"dropdown-item\">
                                                        <i class=\"fi-archive opacity-75 me-2\"></i>Ocultar
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <form class=\"delete-rent-form\" action=\"php-delete-rent.php\" method=\"POST\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"{$rentalId}\">
                                                    <button type=\"submit\" class=\"dropdown-item text-danger\">
                                                        <i class=\"fi-trash opacity-75 me-2\"></i>Eliminar
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
        </div>";
                  }
                } else {
                  echo "<p>No hay rentas promocionadas.</p>";
                }
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </main>

  <script>
    function previewImages(event) {
      const files = event.target.files;
      const preview = document.getElementById('imagePreview');
      preview.innerHTML = ''; // Limpiar el contenedor de previsualización

      if (files.length > 0) {
        for (let i = 0; i < files.length; i++) {
          if (i < 3) {
            const file = files[i];
            const reader = new FileReader();

            reader.onload = function(e) {
              const img = document.createElement('img');
              img.src = e.target.result;
              img.alt = 'Imagen de Renta';
              img.classList.add('img-thumbnail', 'm-1');
              img.style.width = '100px';
              img.style.height = '100px';
              preview.appendChild(img);
            }

            reader.readAsDataURL(file);
          }
        }

        if (files.length > 3) {
          const remainingCount = files.length - 3;
          const moreDiv = document.createElement('div');
          moreDiv.classList.add('d-flex', 'align-items-center', 'justify-content-center', 'img-thumbnail', 'm-1');
          moreDiv.style.width = '100px';
          moreDiv.style.height = '100px';
          moreDiv.style.backgroundColor = '#f8f9fa';
          moreDiv.innerHTML = `<span>+${remainingCount} más</span>`;
          preview.appendChild(moreDiv);
        }
      }
    }

    // Mostrar mensaje con SweetAlert
    <?php if (isset($_GET['status']) && $_GET['status'] == 'success'): ?>
      Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: 'La renta se ha agregado correctamente.'
      });
    <?php elseif (isset($_GET['status']) && $_GET['status'] == 'error'): ?>
      Swal.fire({
        icon: 'error',
        title: 'Error',
        text: 'Hubo un error al agregar la renta. Por favor, inténtalo de nuevo.'
      });
    <?php endif; ?>
  </script>

  <script>
    // Incluir el código PHP generado dentro de HTML
    document.addEventListener('DOMContentLoaded', function() {
      document.getElementById('servicesCheckboxes').innerHTML = `<?php echo $checkboxes; ?>`;
    });
  </script>

  <script>
    // Función genérica para manejar confirmaciones con SweetAlert
    function setupSweetAlert(formSelector, title, text, icon = 'warning', confirmButtonText = 'Confirmar') {
      document.querySelectorAll(formSelector).forEach(form => {
        form.addEventListener('submit', function(e) {
          e.preventDefault();

          // Capturar datos del formulario
          const formData = new FormData(form);
          const data = {};
          formData.forEach((value, key) => data[key] = value);

          // Log para verificar que todo está correcto
          console.log(`Datos a enviar para ${formSelector}:`, data);

          // Mostrar SweetAlert
          Swal.fire({
            title: title,
            text: text,
            icon: icon,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#aaa',
            confirmButtonText: confirmButtonText,
            cancelButtonText: 'Cancelar'
          }).then((result) => {
            if (result.isConfirmed) {
              form.submit(); // Enviar formulario si confirma
            }
          });
        });
      });
    }

    // Configurar SweetAlert para cada acción
    setupSweetAlert('.delete-rent-form', '¿Estás seguro?', 'La renta será eliminada permanentemente', 'warning', 'Sí, eliminar');
    setupSweetAlert('.hide-rent-form', '¿Estás seguro?', 'La renta será ocultada y no será visible públicamente', 'warning', 'Sí, ocultar');
    setupSweetAlert('.promote-rent-form', '¿Estás seguro?', 'La renta será promocionada', 'info', 'Sí, promocionar');
    setupSweetAlert('.unhide-rent-form', '¿Estás seguro?', 'La renta volverá a estar visible', 'info', 'Sí, mostrar');
    setupSweetAlert('.unpromote-rent-form', '¿Estás seguro?', 'La renta dejará de estar promocionada', 'info', 'Sí, quitar promoción');
  </script>

  <!-- Vendor scripts -->
  <script src="../uixsoftware/assets/js/swiper-bundle.min.js"></script>
  <script src="../uixsoftware/assets/js/glightbox.min.js"></script>
  <script src="../uixsoftware/assets/js/choices.min.js"></script>
  <script src="../uixsoftware/assets/js/nouislider.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Bootstrap + Theme scripts -->
  <script src="../uixsoftware/assets/js/theme.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
</body>

</html>