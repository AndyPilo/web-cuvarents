<!DOCTYPE html>
<html lang="en" data-bs-theme="light"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    


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



  
    <link rel="shortcut icon" href="https://www.uixsoftware.com/assets/img/logos/logo_uixsoftware.svg">
  
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
    <script src="../uixsoftware/assets/js/customizer.min.js"></script><style id="customizer-styles">:root,[data-bs-theme="light"]{}[data-bs-theme="dark"]{}.btn-primary{}.btn-success{}.btn-warning{}.btn-danger{}.btn-info{}.btn-outline-primary{}.btn-outline-success{}.btn-outline-warning{}.btn-outline-danger{}.btn-outline-info{}</style>
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

<h1 class="h2 mb-0">Dashboard</h1>

</div>




<div class="p-2 p-md-4 shadow card rounded-5 mb-4">

<h3 class="h4">Mis rentas</h3>

<!-- Published listings -->
<div class="row gap-4" id="publishedSelection">

      <?php

// Obtener las rentas de la base de datos (excluyendo las ocultas)
$sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
        FROM Rentals
        LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
        WHERE Rentals.is_hidden = FALSE
        GROUP BY Rentals.rental_id
        ORDER BY Rentals.rental_id DESC
        LIMIT 2";
$result = $conn->query($sql3);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $images = explode(',', $row['images']);
        $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : 'ruta/a/la/imagen/por/defecto.jpg';
        $rentalId = htmlspecialchars($row['rental_id'], ENT_QUOTES, 'UTF-8');
        $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
        $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
        $rentalLocation = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
        $rentalCreated = date('d/m/Y', strtotime($row['rental_created_at']));
        $rentalEdited = date('d/m/Y', strtotime($row['rental_updated_at']));

        echo "
        <div class=\"col-12 d-sm-flex align-items-center\">
            <article class=\"card w-100\">
                <div class=\"d-sm-none\"></div>
                <div class=\"row g-0\">
                    <div class=\"col-sm-4 col-md-3 rounded overflow-hidden pb-2 pb-sm-0 pe-sm-2\">
                        <a class=\"position-relative d-flex h-100 bg-body-tertiary\" href=\"#\" style=\"min-height: 174px\">
                            <img src=\"$firstImage\" class=\"position-absolute top-0 start-0 w-100 h-100 object-fit-cover\" alt=\"Image\">
                            <div class=\"ratio d-none d-sm-block\" style=\"--fn-aspect-ratio: calc(180 / 240 * 100%)\"></div>
                            <div class=\"ratio ratio-16x9 d-sm-none\"></div>
                        </a>
                    </div>
                    <div class=\"col-sm-8  col-md-9 align-self-center\">
                        <div class=\"card-body row p-3 py-sm-4 ps-sm-2 ps-md-3 pe-md-4 mt-n1 mt-sm-0\">
                            <div class=\"col-12 col-md-8 position-relative pe-3\">
                                <span class=\"badge text-body-emphasis bg-body-secondary mb-2\">$rentalTitle</span>
                                <div class=\"h5 mb-2\">\$$rentalPrice</div>
                                <a class=\"stretched-link d-block fs-sm text-body text-decoration-none mb-2\" href=\"#\">$rentalLocation</a>
                            </div>
                          
                            <div class='col-12 col-md-4'>
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
                                                                        <form action=\"php-promote-rent.php\" method=\"POST\" onsubmit=\"return confirm('¿Estás seguro de que deseas promocionar esta renta?');\">
                                    <input type=\"hidden\" name=\"rental_id\" value=\"$rentalId\">
                                    <button type=\"submit\" class=\"dropdown-item\"><i class=\"fi-zap fs-base opacity-75 me-2\"></i>Promocionar</button>
                                </form>
                            </li>
                                            </li>
                                            <li>
                                                <form action=\"php-hide-rent.php\" method=\"POST\" onsubmit=\"return confirm('¿Estás seguro de que deseas ocultar esta renta?');\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"$rentalId\">
                                                    <button type=\"submit\" class=\"dropdown-item\"><i class=\"fi-archive opacity-75 me-2\"></i>Ocultar</button>
                                                </form>
                                            </li>
                                            <li>
                                                <form action=\"php-delete-rent.php\" method=\"POST\" onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar esta renta?');\">
                                                    <input type=\"hidden\" name=\"rental_id\" value=\"$rentalId\">
                                                    <button type=\"submit\" class=\"dropdown-item text-danger\"><i class=\"fi-trash opacity-75 me-2\"></i>Eliminar</button>
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
    echo "<p>No hay rentas disponibles.</p>";
}
?>


<div>
<a href="rents.php" class="btn btn-dark px-4 rounded-pill">Ver rentas</a>
</div>
</div></div>




<div class="p-2 p-md-4 shadow card rounded-5 mb-4">

<h3 class="h4">Comentarios</h3>

<?php
            // Obtener las recomendaciones de la base de datos
            $sql4 = "SELECT * FROM Recommendations ORDER BY created_at DESC LIMIT 1";
            $result4 = $conn->query($sql4);

            if ($result4->num_rows > 0) {
                while($row4 = $result4->fetch_assoc()) {
                    $userName = htmlspecialchars($row4['user_name'], ENT_QUOTES, 'UTF-8');
                    $userRank = htmlspecialchars($row4['user_rank'], ENT_QUOTES, 'UTF-8');
                    $recommendationText = htmlspecialchars($row4['recommendation_text'], ENT_QUOTES, 'UTF-8');
                    $createdDate = date('M d, Y', strtotime($row4['created_at']));

                    echo "
                    <div class=\"py-2\">
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
                        
                    </div>
                    
                   
                    ";
                }
                $result4->close(); // Cerrar la consulta
            } else {
                echo "<p>No hay recomendaciones disponibles.</p>";
            }
            ?>

<div>
<a href="reviews.php" class="btn btn-dark px-4 rounded-pill">Ver comentarios</a>
</div>

</div>


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
    <script src="../uixsoftware/assets/js/theme.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script> <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  

</body></html>