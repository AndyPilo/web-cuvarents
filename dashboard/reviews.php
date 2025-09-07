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
          <!-- Botón para abrir la Modal -->

          <div class="d-flex justify-content-between pb-3">

            <h1 class="h2 mb-0">Reseñas</h1>

            <!-- Botón para abrir la Modal -->
            <button type="button" class="btn btn-info" data-toggle="modal" data-target="#addReviewModal">
              Agregar Reseña
            </button>
          </div>




          <div class="modal fade" id="addReviewModal" tabindex="-1" aria-labelledby="addReviewModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addReviewModalLabel">Agregar Reseña</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="addReviewForm" action="php-add-review.php" method="POST">
                    <div class="form-group">
                      <label for="reviewText">Tu Reseña</label>
                      <textarea class="form-control" id="reviewText" name="reviewText" rows="4" required></textarea>
                    </div>
                    <div class="form-group">
                      <label for="userName">Tu Nombre</label>
                      <input type="text" class="form-control" id="userName" name="userName" required>
                    </div>
                    <div class="form-group">
                      <label for="userRank">Tu Rango</label>
                      <input type="text" class="form-control" id="userRank" name="userRank" required>
                    </div>
                    <button type="submit" class="btn btn-dark mt-3 w-100">Guardar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>


          <?php
          // Obtener las recomendaciones de la base de datos
          $sql4 = "SELECT * FROM Recommendations ORDER BY created_at DESC";
          $result4 = $conn->query($sql4);

          if ($result4->num_rows > 0) {
            while ($row4 = $result4->fetch_assoc()) {
              $recommendationId = $row4['recommendation_id'];
              $userName = htmlspecialchars($row4['user_name'], ENT_QUOTES, 'UTF-8');
              $userRank = htmlspecialchars($row4['user_rank'], ENT_QUOTES, 'UTF-8');
              $recommendationText = htmlspecialchars($row4['recommendation_text'], ENT_QUOTES, 'UTF-8');
              $createdDate = date('M d, Y', strtotime($row4['created_at']));

              echo "
        <div class=\"border-bottom py-4\">
            <div class=\"d-sm-flex align-items-center mt-2 mb-3\">
                <div class=\"d-flex align-items-center pe-3\">
                    <div class=\"ratio ratio-1x1 flex-shrink-0 bg-body-secondary rounded-circle overflow-hidden bg-gradient-al\" style=\"width: 48px\"></div>
                    <div class=\"ps-3\">
                        <h6 class=\"mb-1\">$userName</h6>
                        <div class=\"fs-xs text-body-secondary\">$createdDate</div>
                    </div>
                </div>
            </div>
            <p class=\"fs-sm mb-2\">Status:<a class=\"hover-effect-underline fw-medium text-dark-emphasis text-decoration-none ms-2\" href=\"#\">$userRank</a></p>
            <p class=\"fs-sm\">$recommendationText</p>
            <form action='php-eliminar-comentario.php' method='POST' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este comentario?');\">
                <input type='hidden' name='id' value='$recommendationId'>
                <button type='submit' class='btn btn-dark p-2'>Eliminar</button>
            </form>
        </div>";
            }
            $result4->close(); // Cerrar la consulta
          } else {
            echo "<p>No hay recomendaciones disponibles.</p>";
          }
          ?>


        </div>
      </div>
    </div>
  </main>



  <!-- Vendor scripts -->
  <script src="../uixsoftware/assets/js/swiper-bundle.min.js"></script>
  <script src="../uixsoftware/assets/js/glightbox.min.js"></script>
  <script src="../uixsoftware/assets/js/choices.min.js"></script>
  <script src="../uixsoftware/assets/js/nouislider.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.3/dist/sweetalert2.min.js"></script>
  <!-- Bootstrap + Theme scripts -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="../uixsoftware/assets/js/theme.min.js"></script>