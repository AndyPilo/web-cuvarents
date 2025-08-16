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


    <link rel="icon" href="/uixsoftware/assets/img/favicon-32x32.png" type="image/png">


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
                // Captura el valor de búsqueda enviado por GET
                $search = isset($_GET['search']) ? trim($_GET['search']) : '';

                // Construir la consulta SQL dinámica
                $sql = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images 
        FROM Rentals
        LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
        WHERE Rentals.is_hidden = FALSE";

                // Agregar condición de búsqueda
                if (!empty($search)) {
                    $search = $conn->real_escape_string($search); // Evitar inyección SQL
                    $sql .= " AND (
        rental_title LIKE '%$search%' OR
        rental_provincia LIKE '%$search%' OR
        rental_municipio LIKE '%$search%' OR
        rental_category LIKE '%$search%'
    )";
                }

                $sql .= " GROUP BY Rentals.rental_id ORDER BY Rentals.is_promoted DESC";

                // Ejecutar la consulta
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        // Mostrar los resultados
                        $rentalId = $row['rental_id'];
                        $images = explode(',', $row['images']);
                        $firstImage = !empty($images[0]) ? 'uploads/' . $images[0] : 'ruta/a/la/imagen/por/defecto.jpg';
                        $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                        $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
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
                        foreach ($images as $index => $image) {
                            if ($imageCount >= 4) break; // Limitar a 4 imágenes
                            $slideImage = !empty($image) ? 'uploads/' . $image : 'ruta/a/la/imagen/por/defecto.jpg';
                            $slides .= "
            <div class=\"swiper-slide\" role=\"group\" aria-label=\"" . ($index + 1) . " / " . count($images) . "\" style=\"width: 304px;\">
                <div class=\"ratio d-block\" style=\"--fn-aspect-ratio: calc(248 / 362 * 100%)\">
                    <img src=\"./dashboard/$slideImage\" loading=\"lazy\" alt=\"Image\">
                    <span class=\"position-absolute top-0 start-0 w-100 h-100 z-1\" style=\"background: linear-gradient(180deg, rgba(0,0,0, 0) 0%, rgba(0,0,0, .11) 100%)\"></span>
                </div>
            </div>";
                            $imageCount++;
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
                    </div>
                    <div class=\"h5 mb-2\">\$$rentalPrice</div>
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