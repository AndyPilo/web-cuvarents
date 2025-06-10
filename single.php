<!DOCTYPE html>
<html lang="es" data-bs-theme="light">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <!-- Meta tags -->
    <title>CuVaRents</title>
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


    <main class="content-wrapper">
        <div class="container pt-4 pb-5 mb-xxl-3">


            <?php
            // Obtener el ID de la renta desde la URL
            $rentalId = isset($_GET['id']) ? (int)$_GET['id'] : 0;

            // Verificar que el ID sea válido
            if ($rentalId <= 0) {
                echo "Renta no encontrada.";
                exit();
            }

            // Obtener los detalles de la renta desde la base de datos
            $sql = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images FROM Rentals
        LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
        WHERE Rentals.rental_id = $rentalId
        GROUP BY Rentals.rental_id";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $images = !empty($row['images']) ? explode(',', $row['images']) : [];
                if (!empty($images[0])) {
                    $firstImage = 'uploads/' . $images[0]; // ruta relativa
                    $firstImageFull = 'dashboard/' . $firstImage; // para href y src
                } else {
                    $firstImage = 'uixsoftware/assets/img/default-img.png';
                    $firstImageFull = $firstImage; // ya está en public path
                }
                $rentalTitle = htmlspecialchars($row['rental_title'], ENT_QUOTES, 'UTF-8');
                $rentalPrice = htmlspecialchars($row['rental_price'], ENT_QUOTES, 'UTF-8');
                $rentalProvincia = htmlspecialchars($row['rental_provincia'], ENT_QUOTES, 'UTF-8');
                $rentalMunicipio = htmlspecialchars($row['rental_municipio'], ENT_QUOTES, 'UTF-8');
                $rentalDescription = htmlspecialchars($row['rental_description'], ENT_QUOTES, 'UTF-8');
                $rentalPriceType = htmlspecialchars($row['rental_price_type'], ENT_QUOTES, 'UTF-8');
                $typeTimeRent = htmlspecialchars($row['type_time_rent'], ENT_QUOTES, 'UTF-8');
                $rentalRooms = intval($row['rental_rooms']);
                $rentalCapacity = intval($row['rental_capacity']);
                $isPromoted = $row['is_promoted'];

                // Obtener los servicios de la renta
                $sqlServices = "SELECT services_rent_name, services_rent_icon_svg FROM services_rent
                    JOIN RentalServices ON services_rent.services_rent_id = RentalServices.service_rent_id
                    WHERE RentalServices.rental_id = $rentalId";
                $resultServices = $conn->query($sqlServices);

                $servicesIcons = "";
                while ($service = $resultServices->fetch_assoc()) {
                    $servicesIcons .= '<div class="col-6 col-md-3 d-flex align-items-center">' . $service['services_rent_icon_svg'] . '' . htmlspecialchars($service['services_rent_name']) . '</div>';
                }

                echo "
    <!-- Breadcrumb -->
    <nav class=\"pb-2 pb-md-3\" aria-label=\"breadcrumb\">
        <ol class=\"breadcrumb\">
            <li class=\"breadcrumb-item\"><a href=\"home-real-estate.html\">Inicio</a></li>
            <li class=\"breadcrumb-item\"><a href=\"./rents\">Propiedad en alquiler</a></li>
            <li class=\"breadcrumb-item active\" aria-current=\"page\">$rentalTitle</li>
        </ol>
    </nav>

    <!-- Image gallery -->
    <div class=\"row g-3 g-lg-4\">
        <div class=\"col-md-8\">
            <a class=\"hover-effect-scale hover-effect-opacity position-relative d-flex rounded overflow-hidden\" href=\"$firstImageFull\" data-glightbox=\"\" data-gallery=\"image-gallery\">
                <i class=\"fi-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2\"></i>
                <span class=\"hover-effect-target position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 opacity-0 z-1\"></span>
                <div class=\"ratio hover-effect-target bg-body-tertiary rounded\" style=\"--fn-aspect-ratio: calc(450 / 856 * 100%)\">
                    <img src=\"$firstImageFull\" alt=\"Image\">
                </div>
            </a>
        </div>";

                // Mostrar hasta 3 imágenes adicionales
                for ($i = 1; $i < count($images); $i++) {
                    $image = 'uploads/' . $images[$i];
                    if ($i <= 3) {
                        echo "
            <div class=\"col-md-4 vstack gap-3 gap-lg-4\">
                <a class=\"hover-effect-scale h-100 hover-effect-opacity position-relative d-flex rounded overflow-hidden\" href=\"dashboard/$image\" data-glightbox=\"\" data-gallery=\"image-gallery\">
                    <i class=\"fi-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2\"></i>
                    <span class=\"hover-effect-target position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 opacity-0 z-1\"></span>
                    <div class=\"ratio hover-effect-target bg-body-tertiary rounded\" style=\"--fn-aspect-ratio: calc(213 / 416 * 100%)\">
                        <img src=\"dashboard/$image\" alt=\"Image\">
                    </div>
                </a>
            </div>";
                    } else if ($i === 4) {
                        $remainingImages = count($images) - 4;
                        echo "
            <div class=\"col-md-4 vstack gap-3 gap-lg-4\">
                <a class=\"hover-effect-scale h-100 hover-effect-opacity position-relative d-flex rounded overflow-hidden\" href=\"dashboard/$image\" data-glightbox=\"\" data-gallery=\"image-gallery\">
                    <i class=\"fi-zoom-in hover-effect-target fs-3 text-white position-absolute top-50 start-50 translate-middle opacity-0 z-2\"></i>
                    <span class=\"hover-effect-target position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-25 opacity-0 z-1\"></span>
                    <div class=\"ratio hover-effect-target bg-body-tertiary rounded\" style=\"--fn-aspect-ratio: calc(213 / 416 * 100%)\">
                        <img src=\"dashboard/$image\" alt=\"Image\">
                        <div class=\"position-absolute top-0 start-0 w-100 h-100 bg-black bg-opacity-75 d-flex align-items-center justify-content-center\">
                            <span class=\"text-white fs-3\">+$remainingImages</span>
                        </div>
                    </div>
                </a>
            </div>";
                        break;
                    }
                }

                // Añadir enlaces ocultos para las imágenes adicionales
                for ($i = 4; $i < count($images); $i++) {
                    $image = 'uploads/' . $images[$i];
                    echo "<a class=\"d-none\" href=\"dashboard/$image\" data-glightbox=\"\" data-gallery=\"image-gallery\"></a>";
                }

                echo "
    </div>

    <!-- Listing details -->
    <div class=\"row pt-4 pb-2 pb-sm-3 pb-md-4 py-lg-5 mt-sm-2 mt-lg-0\">

        <!-- Content sections -->
        <div class=\"col-lg-8 col-xl-7 pb-3 pb-sm-0 mb-4 mb-sm-5 mb-lg-0\">

            <!-- Badges + Sharing and wishlist buttons -->
            <div class=\"d-flex align-items-center justify-content-between gap-4 mb-3\">
                " . ($isPromoted ? "<span class=\"badge bg-warning\">VIP</span>" : "") . "
            </div>

            <!-- Price + Address + Facilities -->
            <div class=\"h3 pb-1 mb-2\">\$$rentalPrice <span class=\"fs-sm text-muted\">($rentalPriceType)</span></div>
            <p class=\"fs-sm pb-1 mb-2\">$rentalProvincia, $rentalMunicipio</p>
            <p class=\"fs-sm pb-1 mb-2\"><strong>Tipo de renta:</strong> $typeTimeRent</p>

            <!-- About -->
            <h2 class=\"h5 pt-4 pt-sm-5 mt-3 mt-sm-0\">Acerca de</h2>
            <p class=\"fs-sm\">$rentalDescription</p>

            <!-- Habitaciones y Capacidad -->
            <p class=\"fs-sm pb-1 mb-2\"><strong>Habitaciones:</strong> $rentalRooms</p>
            <p class=\"fs-sm pb-1 mb-2\"><strong>Capacidad:</strong> $rentalCapacity personas</p>

            <div class=\"row g-3\">
                <h2 class=\"h5 pt-4 pt-sm-5 mt-3 mt-sm-0\">Comodidades</h2>
                $servicesIcons
            </div>

        </div>
    ";
            } else {
                echo "Renta no encontrada.";
            }
            ?>




            <!-- Sidebar with contact form that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
            <aside class="col-lg-4 offset-xl-1">
                <div class="d-none d-lg-block" style="margin-top: -105px"></div>
                <div class="sticky-lg-top">
                    <div class="d-none d-lg-block" style="height: 105px"></div>
                    <div class="card shadow rounded-5 rounded p-4">
                        <div class="p-sm-2 p-lg-0 p-xl-2">

                            <!-- Botón para abrir el modal -->
                            <button type="button" class="btn btn-lg btn-info w-100 rounded-pill" data-bs-toggle="modal" data-bs-target="#addGestorModal">
                                Reservar
                            </button>




                            <div class="fs-xs text-center pt-1 pb-2 my-2">Esta reserva se enviaría a nuestros gestores</div>
                            <div class="d-flex align-items-center mb-3">
                                <hr class="w-100 m-0">
                                <div class="mt-n1 px-3">o</div>
                                <hr class="w-100 m-0">
                            </div>
                            <!-- Botón para enviar mensaje a WhatsApp -->
                            <button type="button" class="btn btn-lg btn-outline-dark w-100 rounded-pill" id="contactBtn">Envíanos un mensaje</button>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    document.getElementById('contactBtn').addEventListener('click', function() {
                                        fetch('php-get-gestor-activo.php')
                                            .then(response => response.json())
                                            .then(data => {
                                                if (data.telefono) {
                                                    const telefono = data.telefono;
                                                    const mensaje = encodeURIComponent("Hola, vengo de su sitio web cuvarents");
                                                    const whatsappUrl = `https://wa.me/${telefono}?text=${mensaje}`;
                                                    console.log('WhatsApp URL:', whatsappUrl);
                                                    window.location.href = whatsappUrl; // Usar window.location.href en lugar de window.open
                                                } else {
                                                    alert('No hay gestores activos disponibles.');
                                                }
                                            })
                                            .catch(error => console.error('Error:', error));
                                    });
                                });
                            </script>

                        </div>
                    </div>
                </div>
            </aside>
        </div>
        </div>
    </main>


    <!-- Modal para enviar reserva -->
    <div class="modal fade" id="addGestorModal" tabindex="-1" aria-labelledby="addGestorModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addGestorModalLabel">Enviar reservación</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="sendReserveForm">
                        <div class="form-group">
                            <label for="nombre">Nombre y Apellidos</label>
                            <input type="text" class="form-control" id="nombre" name="nombre" required>
                        </div>
                        <button type="submit" class="btn btn-dark w-100 mt-3 rounded-pill">Enviar reserva</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('sendReserveForm').addEventListener('submit', function(event) {
                event.preventDefault();

                const nombre = document.getElementById('nombre').value;
                const rentalId = <?php echo $rentalId; ?>; // Obtener el ID de la renta desde PHP
                const currentUrl = window.location.href; // Obtener la URL actual del navegador

                console.log('Nombre:', nombre);
                console.log('Rental ID:', rentalId);
                console.log('Current URL:', currentUrl);

                // Hacer una solicitud para obtener los detalles de la renta y el número del gestor activo
                fetch('php-get-rental-and-gestor.php?rental_id=' + rentalId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.telefono && data.rental) {
                            const telefono = data.telefono;
                            const rental = data.rental;
                            const mensaje = `Hola, me gustaría reservar la renta:\n\n` +
                                `Nombre: ${rental.rental_title}\n` +
                                `Precio: ${rental.rental_price} (${rental.rental_price_type})\n` +
                                `Ubicación: ${rental.rental_provincia}, ${rental.rental_municipio}\n` +
                                `Tipo de Renta: ${rental.type_time_rent}\n\n` +
                                `Enlace de la renta: ${currentUrl}\n\n` +
                                `Nombre del cliente: ${nombre}`;
                            const whatsappUrl = `https://wa.me/${telefono}?text=${encodeURIComponent(mensaje)}`;
                            console.log('WhatsApp URL:', whatsappUrl);
                            window.location.href = whatsappUrl; // Usar window.location.href en lugar de window.open
                        } else {
                            alert('No hay gestores activos disponibles o no se pudieron obtener los detalles de la renta.');
                        }
                    })
                    .catch(error => console.error('Error:', error));
            });
        });
    </script>




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