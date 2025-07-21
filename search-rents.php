<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <!-- Meta tags -->
    <title>CuVaRents | Explorar Rentas</title>
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


    <link rel="shortcut icon" href="https://www.uixsoftware.com/assets/img/logos/logo_uixsoftware.svg">


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


        </div>
        </div>


        <!-- Property listings -->
        <section class="container mt-2 mt-md-3 mt-lg-5 pb-5">
            <h2 class="pb-2 pb-lg-3">Rentas populares</h2>

            <!-- Properties grid -->
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 g-md-3 g-lg-4">
                <?php
                $precio = isset($_GET['precio']) ? $_GET['precio'] : [];
                $zona = isset($_GET['municipio']) ? $_GET['municipio'] : [];
                $habitaciones = isset($_GET['habitaciones']) ? intval($_GET['habitaciones']) : 0;
                $capacidad = isset($_GET['capacidad']) ? intval($_GET['capacidad']) : 0;
                $servicios = isset($_GET['servicios']) ? $_GET['servicios'] : [];
                $search = isset($_GET['search']) ? trim($_GET['search']) : '';

                // Construir la consulta SQL dinámica
                $sql3 = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
        FROM Rentals
        LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
        WHERE Rentals.is_hidden = FALSE";

                // Agregar condición de búsqueda
                if (!empty($search)) {
                    $search = $conn->real_escape_string($search); // Evitar inyección SQL
                    $sql3 .= " AND (
        rental_title LIKE '%$search%' OR
        rental_provincia LIKE '%$search%' OR
        rental_municipio LIKE '%$search%' OR
        rental_category LIKE '%$search%'
    )";
                }

                if (!empty($precio)) {
                    $priceConditions = [];
                    foreach ($precio as $p) {
                        switch ($p) {
                            case '<50':
                                $priceConditions[] = "rental_price < 50";
                                break;
                            case '50-100':
                                $priceConditions[] = "rental_price BETWEEN 50 AND 100";
                                break;
                            case '100-200':
                                $priceConditions[] = "rental_price BETWEEN 100 AND 200";
                                break;
                            case '>200':
                                $priceConditions[] = "rental_price > 200";
                                break;
                        }
                    }
                    $sql3 .= " AND (" . implode(' OR ', $priceConditions) . ")";
                }

                if (!empty($zona)) {
                    $sql3 .= " AND rental_municipio IN ('" . implode("','", $zona) . "')";
                }

                if ($habitaciones > 0) {
                    $sql3 .= " AND rental_rooms = $habitaciones";
                }

                if ($capacidad > 0) {
                    $sql3 .= " AND rental_capacity = $capacidad";
                }

                if (!empty($servicios)) {
                    $sql3 .= " AND Rentals.rental_id IN (
        SELECT rental_id 
        FROM RentalServices 
        WHERE service_rent_id IN ('" . implode("','", $servicios) . "') 
        GROUP BY rental_id 
        HAVING COUNT(DISTINCT service_rent_id) = " . count($servicios) . "
    )";
                }

                $sql3 .= " GROUP BY Rentals.rental_id ORDER BY Rentals.is_promoted DESC";

                $result = $conn->query($sql3);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $rentalId = $row['rental_id'];
                        $images = !empty($row['images']) ? explode(',', $row['images']) : [];
                        $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : 'uixsoftware/assets/img/default-img.png';
                        $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                        $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
                        $rentalHab = htmlspecialchars($row['rental_rooms'], ENT_QUOTES, 'UTF-8');
                        $rentalPriceType = htmlspecialchars($row['rental_price_type'], ENT_QUOTES, 'UTF-8');
                        $rentalLocation = htmlspecialchars($row['rental_provincia'] . ', ' . $row['rental_municipio'], ENT_QUOTES, 'UTF-8');
                        $rentalCreated = date('d/m/Y', strtotime($row['rental_created_at']));
                        $rentalEdited = date('d/m/Y', strtotime($row['rental_updated_at']));
                        $isPromoted = $row['is_promoted'];

                        // Obtener los servicios de la renta
                        $sqlServices = "SELECT services_rent_name, services_rent_icon_svg FROM services_rent
                        JOIN RentalServices ON services_rent.services_rent_id = RentalServices.service_rent_id
                        WHERE RentalServices.rental_id = " . $row['rental_id'];
                        $resultServices = $conn->query($sqlServices);

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
            <img src=\"uixsoftware/assets/img/default-img.png\" alt=\"Imagen gris con una casita en medio que se muestra por defecto cuando una renta no tiene fotos\">
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
                <img src=\"./dashboard/$slideImage\" alt=\"Imagen " . ($index + 1) . " de $rentalTitle\">
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
                        <a class=\"swiper-wrapper\" href=\"./single.php?id=$rentalId\" aria-live=\"polite\">
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
                    <div class=\"h5 mb-2\">\$$rentalPrice <span class=\"fs-sm text-muted\">($rentalPriceType)</span></div>
                    <h3 class=\"fs-sm fw-normal text-body mb-2\">
                        <a class=\"stretched-link text-body\" href=\"./single.php?id=$rentalId\">$rentalTitle</a>
                    </h3>
                    <div class=\"h6 fs-sm mb-0\">Información adicional</div>
                </div>
                <div class=\"card-footer d-flex gap-2 border-0 bg-transparent pt-0 pb-3 px-3 mt-n1\">
                    $servicesIcons
                </div>
            </article>
        </div>";
                    }
                } else {
                    echo "<p>No hay rentas disponibles para esa búsqueda.</p>";
                }
                ?>





            </div>
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