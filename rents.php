<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <!-- Meta tags -->
    <title>CuVaRents | Explorar Rentas en Cuba</title>

    <?php
    // Detectar si está en localhost o producción
    $basePath = '/';
    if (isset($_SERVER['HTTP_HOST']) && $_SERVER['HTTP_HOST'] === 'localhost') {
        $basePath = '/web-cuvarents/';
    }
    ?>

    <base href="<?php echo $basePath; ?>">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Uixsoftware">
    <meta name="keywords" content="rentas en Cuba, alquileres en Cuba, apartamentos en Cuba, casas en Cuba, CuVaRents, Uixsoftware, alquiler de viviendas, La Habana, Santiago de Cuba, Matanzas, provincia, municipio, Cuba">
    <meta name="description" content="CuVaRents ofrece una amplia selección de propiedades en alquiler en toda Cuba. Encuentra tu hogar ideal en La Habana, Santiago de Cuba, Matanzas y más. Desarrollado por Uixsoftware.">
    <meta property="og:description" content="CuVaRents ofrece una amplia selección de propiedades en alquiler en toda Cuba. Encuentra tu hogar ideal en La Habana, Santiago de Cuba, Matanzas y más. Desarrollado por Uixsoftware.">
    <meta property="og:url" content="https://www.cuvarents.com/">
    <meta property="og:image" content="https://www.cuvarents.com/assets/img/logos/logo_qvarents.svg">
    <meta property="og:type" content="website">
    <meta property="og:title" content="CuVaRents | Alquileres en Cuba">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="CuVaRents | Alquileres en Cuba">
    <meta name="twitter:description" content="CuVaRents ofrece una amplia selección de propiedades en alquiler en toda Cuba. Encuentra tu hogar ideal en La Habana, Santiago de Cuba, Matanzas y más. Desarrollado por Uixsoftware.">
    <meta name="twitter:image" content="https://www.cuvarents.com/assets/img/logos/logo_qvarents.svg">
    <meta name="contact" content="soporte@cuvarents.com">
    <meta name="copyright" content="Copyright (c) 2024. Uixsoftware. Todos los derechos reservados.">
    <meta name="DC.title" content="CuVaRents: Líderes en Alquileres en Cuba">
    <meta name="geo.placename" content="Cuba">
    <meta name="geo.region" content="CU">


    <link rel="icon" href="/uixsoftware/assets/img/favicon-32x32.png" type="image/png">

    <!-- CANNONICAL -->
    <link rel="canonical" href="https://cuvarents.com/rents" />

    <!-- Theme switcher (color modes) -->
    <script src="uixsoftware/assets/js/theme-switcher.js"></script>

    <!-- Preloaded local web font (Inter) -->
    <link href="uixsoftware/assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin="">

    <!-- Font icons -->
    <link rel="stylesheet" href="uixsoftware/assets/css/finder-icons.min.css">
    <link href="uixsoftware/assets/fonts/finder-icons.woff2" as="font" type="font/woff2" crossorigin="">

    <!-- Vendor styles -->
    <link rel="stylesheet" href="uixsoftware/assets/css/swiper-bundle.min.css">
    <link rel="stylesheet" href="uixsoftware/assets/css/glightbox.min.css">
    <link rel="stylesheet" href="uixsoftware/assets/css/choices.min.css">
    <link rel="stylesheet" href="uixsoftware/assets/css/nouislider.min.css">
    <!-- Bootstrap + Theme styles -->
    <link rel="preload" href="uixsoftware/assets/css/theme.min.css" as="style">

    <link rel="stylesheet" href="uixsoftware/assets/css/theme.min.css" id="theme-styles">

    <!-- Customizer -->
    <script src="uixsoftware/assets/js/customizer.min.js"></script>
    <style id="customizer-styles">
        :root,
        [data-bs-theme="light"] {}

        [data-bs-theme="dark"] {}

        .btn-primary {}

        .btn-success {}

        .btn-warning {}

        .btn-danger {}

        .btn-info {}

        .btn-outline-primary {}

        .btn-outline-success {}

        .btn-outline-warning {}

        .btn-outline-danger {}

        .btn-outline-info {}
    </style>
</head>


<!-- Body -->

<body>

    <?php include 'navbar.php'; ?>

    <!-- Page content -->
    <main class="content-wrapper">

        <?php include 'search.php'; ?>





        <style>
            .buttonz {
                width: 120px;
                height: 40px;
                display: flex;
                align-items: center;
                justify-content: flex-start;
                gap: 10px;
                background-color: rgb(29, 45, 64);
                border-radius: 30px;
                color: rgb(167, 248, 255);
                font-weight: 600;
                border: none;
                position: relative;
                cursor: pointer;
                transition-duration: .2s;
                box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.116);
                padding-left: 8px;
                transition-duration: .5s;
            }

            .svgIconz {
                height: 25px;
                fill: rgb(167, 248, 255) !important;
                transition-duration: 1.5s;
            }

            .bell path {
                fill: rgb(167, 248, 255) !important;
            }

            .buttonz:hover {
                color: rgb(29, 45, 64);
                background-color: rgb(167, 248, 255);
                transition-duration: .2s;
            }

            .buttonz:active {
                transform: scale(0.97);
                transition-duration: .2s;
            }

            .buttonz:hover .svgIconz {
                fill: rgb(29, 45, 64) !important;
                transform: rotate(250deg);
                transition-duration: 1.5s;
            }
        </style>
        </div>
        </div>



        <!-- Property listings -->
        <section class="container mt-2 mt-md-3 mt-lg-5 pb-5">
            <h2 class="pb-2 pb-lg-3">Rentas populares</h2>

            <!-- Properties grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 g-md-3 g-lg-4">

                <?php
                // Función para convertir categoría en slug amigable
                function slugify($string)
                {
                    $string = strtolower(trim($string));
                    $string = preg_replace('/[^a-z0-9]+/i', '-', $string);
                    return trim($string, '-');
                }

                // Obtener el número de página actual desde la URL
                $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
                $itemsPerPage = 8; // Número de rentas por página
                $offset = ($page - 1) * $itemsPerPage;

                if (isset($_GET['category'])) {
                    // Slug desde la URL
                    $category_slug = $_GET['category'];

                    // Convertir guiones en espacios para coincidir con la base de datos
                    $category = str_replace('-', ' ', $category_slug);
                } else {
                    $category = '';
                }

                // Crear slug SEO para usar en los enlaces de paginación
                $categorySlug = $category ? slugify($category) : '';

                // Construir la consulta SQL según si se proporciona una categoría
                if ($category) {
                    $sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
            FROM Rentals
            LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
            WHERE Rentals.is_hidden = FALSE AND Rentals.rental_category = ?
            GROUP BY Rentals.rental_id
            ORDER BY Rentals.is_promoted DESC, Rentals.rental_id DESC
            LIMIT ? OFFSET ?";
                    $stmt = $conn->prepare($sql3);
                    $stmt->bind_param("sii", $category, $itemsPerPage, $offset);
                } else {
                    $sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
            FROM Rentals
            LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
            WHERE Rentals.is_hidden = FALSE
            GROUP BY Rentals.rental_id
            ORDER BY Rentals.is_promoted DESC, Rentals.rental_id DESC
            LIMIT ? OFFSET ?";
                    $stmt = $conn->prepare($sql3);
                    $stmt->bind_param("ii", $itemsPerPage, $offset);
                }

                $stmt->execute();
                $result = $stmt->get_result();

                // Obtener el número total de rentas para la paginación
                if ($category) {
                    $sqlTotal = "SELECT COUNT(DISTINCT Rentals.rental_id) AS total 
                 FROM Rentals 
                 LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                 WHERE Rentals.is_hidden = FALSE AND Rentals.rental_category = ?";
                    $stmtTotal = $conn->prepare($sqlTotal);
                    $stmtTotal->bind_param("s", $category);
                } else {
                    $sqlTotal = "SELECT COUNT(DISTINCT Rentals.rental_id) AS total 
                 FROM Rentals 
                 LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                 WHERE Rentals.is_hidden = FALSE";
                    $stmtTotal = $conn->prepare($sqlTotal);
                }

                $stmtTotal->execute();
                $resultTotal = $stmtTotal->get_result();
                $rowTotal = $resultTotal->fetch_assoc();
                $totalRentals = $rowTotal['total'];
                $totalPages = ceil($totalRentals / $itemsPerPage);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rentalId = $row['rental_id'];
                        $images = !empty($row['images']) ? explode(',', $row['images']) : [];
                        $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : 'uixsoftware/assets/img/default-img.png';
                        $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                        $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');

                        // Si el precio es 1, mostrar "Consultar" en vez de "1$"
                        if ($rentalPrice == "1") {
                            $rentalPriceDisplay = "Consultar";
                        } else {
                            $rentalPriceDisplay = "$" . $rentalPrice;
                        }

                        $rentalHab = htmlspecialchars($row['rental_rooms'], ENT_QUOTES, 'UTF-8');
                        $rentalPriceType = htmlspecialchars($row['rental_price_type'], ENT_QUOTES, 'UTF-8');
                        $rentalLocation = htmlspecialchars($row['rental_provincia'] . ', ' . $row['rental_municipio'], ENT_QUOTES, 'UTF-8');
                        $rentalCreated = date('d/m/Y', strtotime($row['rental_created_at']));
                        $rentalEdited = date('d/m/Y', strtotime($row['rental_updated_at']));
                        $isPromoted = $row['is_promoted'];

                        // Obtener los servicios de la renta
                        $sqlServices = "SELECT services_rent_name, services_rent_icon_svg FROM services_rent
                        JOIN RentalServices ON services_rent.services_rent_id = RentalServices.service_rent_id
                        WHERE RentalServices.rental_id = ?";
                        $stmtServices = $conn->prepare($sqlServices);
                        $stmtServices->bind_param("i", $rentalId);
                        $stmtServices->execute();
                        $resultServices = $stmtServices->get_result();

                        $servicesIcons = "";
                        $totalServices = $resultServices->num_rows;
                        $count = 0;

                        while ($service = $resultServices->fetch_assoc()) {
                            if ($count < 5) {
                                $servicesIcons .= $service['services_rent_icon_svg'];
                            }
                            $count++;
                        }

                        if ($totalServices > 5) {
                            $servicesIcons .= '<span class="fs-sm ms-2">+' . ($totalServices - 5) . '</span>';
                        }

                        // Generar las slides del Swiper
                        $slides = "";
                        $imageCount = 0;
                        if (empty($images)) {
                            // Si no hay imágenes, agregar 1 slide con la imagen por defecto
                            $slides .= "
    <div class=\"swiper-slide\">
        <div class=\"ratio d-block\" style=\"--fn-aspect-ratio: calc(248 / 362 * 100%)\">
            <img src=\"uixsoftware/assets/img/default-img.png\" loading=\"lazy\" alt=\"Imagen gris con una casita en medio que se muestra por defecto cuando una renta no tiene fotos\">
            <span class=\"position-absolute top-0 start-0 w-100 h-100 z-1\" style=\"background: linear-gradient(180deg, rgba(0,0,0, 0) 0%, rgba(0,0,0, .11) 100%)\"></span>
        </div>
    </div>";
                        } else {
                            foreach ($images as $index => $image) {
                                if ($imageCount >= 4) break;
                                $slideImage = !empty($image) ? 'uploads/' . $image : 'uixsoftware/assets/img/default-img.png';
                                $slides .= "
        <div class=\"swiper-slide\" role=\"group\" aria-label=\"" . ($index + 1) . " / " . count($images) . "\" style=\"width: 304px;\">
            <div class=\"ratio d-block\" style=\"--fn-aspect-ratio: calc(248 / 362 * 100%)\">
                <img src=\"./dashboard/$slideImage\" loading=\"lazy\" alt=\"Imagen " . ($index + 1) . " de $rentalTitle\">
                <span class=\"position-absolute top-0 start-0 w-100 h-100 z-1\" style=\"background: linear-gradient(180deg, rgba(0,0,0, 0) 0%, rgba(0,0,0, .11) 100%)\"></span>
            </div>
        </div>";
                                $imageCount++;
                            }
                        }

                        echo "
        <div class=\"col\">
            <article class=\"card shadow hover-effect-opacity h-100\">
                <div class=\"card-img-top position-relative bg-body-tertiary overflow-hidden\">
                    <div class=\"swiper z-2\" data-swiper='{\"pagination\": {\"el\": \".swiper-pagination\"}, \"navigation\": {\"prevEl\": \".btn-prev\", \"nextEl\": \".btn-next\"}, \"breakpoints\": {\"991\": {\"allowTouchMove\": false}}}'>
                        <a class=\"swiper-wrapper\" href=\"./single/$rentalId\" aria-live=\"polite\">
                            $slides
                        </a>
                        <div class=\"swiper-pagination bottom-0 mb-2\"></div>
                    </div>
                </div>
                <div class=\"card-body p-3\">
                    <div class=\"pb-1 mb-2\">
                        <span class=\"badge text-body-emphasis bg-body-secondary\">$rentalLocation</span>
                        " . ($isPromoted ? "<span class=\"badge bg-warning ms-2\">VIP</span>" : "") . "
                                                  <span class='ms-2'>
                         $rentalHab
                          <svg xmlns='http://www.w3.org/2000/svg' width='18' height='18' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='1.5' stroke-linecap='round' stroke-linejoin='round' class='icon icon-tabler icons-tabler-outline icon-tabler-bed'>
  <path stroke='none' d='M0 0h24v24H0z' fill='none'></path>
  <path d='M7 9m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0'></path>
  <path d='M22 17v-3h-20'></path>
  <path d='M2 8v9'></path>
  <path d='M12 14h10v-2a3 3 0 0 0 -3 -3h-7v5z'></path>
</svg>

                          </span>
                    </div>
                    <div class=\"h5 mb-2\"> $rentalPriceDisplay <span class=\"fs-sm text-muted\">($rentalPriceType)</span></div>
                    <h3 class=\"fs-sm fw-normal text-body mb-2\">
                        <a class=\"stretched-link text-body\" href=\"./single/$rentalId\">$rentalTitle</a>
                    </h3>
                    <div class=\"h6 fs-sm mb-0\">Información adicional</div>
                </div>
                <div class=\"card-footer d-flex gap-2 border-0 bg-transparent pt-0 pb-3 px-3 mt-n1\">
                    $servicesIcons
                </div>
            </article>
        </div>";
                    }

                    // Generar la paginación amigable
                    echo '</div> <nav class="pt-5 mt-3" aria-label="Listings pagination">
    <ul class="pagination pagination-lg">';

                    // Base de la URL: con o sin categoría
                    $baseUrl = $categorySlug ? "rents/$categorySlug" : "rents";

                    if ($page > 1) {
                        echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '/page/' . ($page - 1) . '">Anterior</a></li>';
                    }

                    for ($i = 1; $i <= $totalPages; $i++) {
                        if ($i == $page) {
                            echo '<li class="page-item active" aria-current="page">
                                    <span class="page-link">' . $i . '<span class="visually-hidden">(current)</span></span>
                                </li>';
                        } else {
                            echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '/page/' . $i . '">' . $i . '</a></li>';
                        }
                    }

                    if ($page < $totalPages) {
                        echo '<li class="page-item"><a class="page-link" href="' . $baseUrl . '/page/' . ($page + 1) . '">Siguiente</a></li>';
                    }

                    echo '</ul></nav>';
                } else {
                    echo "<p>No hay rentas disponibles.</p>";
                }

                $stmt->close();
                ?>





        </section>


        <?php include 'testimonialComponent.php'; ?>

    </main>

    <?php include 'footer.php'; ?>



    <!-- Vendor scripts -->
    <script src="uixsoftware/assets/js/swiper-bundle.min.js"></script>
    <script src="uixsoftware/assets/js/glightbox.min.js"></script>
    <script src="uixsoftware/assets/js/choices.min.js"></script>
    <script src="uixsoftware/assets/js/nouislider.min.js"></script>

    <!-- Bootstrap + Theme scripts -->
    <script src="uixsoftware/assets/js/theme.min.js"></script>


</body>

</html>