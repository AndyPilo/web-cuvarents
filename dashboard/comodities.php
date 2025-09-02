<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">



  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Meta tags -->
  <title>Servicios de Rentas</title>
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


  <main class="content-wrapper">
    <div class="container pt-4 pt-sm-5 pb-5 mb-xxl-3">
      <div class="row pt-2 pt-sm-0 pt-lg-2 pb-2 pb-sm-3 pb-md-4 pb-lg-5">


        <?php include "sidebar.php" ?>

        <!-- Account settings content -->
        <div class="col-lg-9">

          <div class="d-flex justify-content-between pb-5">

            <h1 class="h2 mb-0">Servicios de rentas</h1>

            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addServiceModal">
              Agregar Servicio
            </button>

          </div>




          <!-- Modal para agregar servicios -->
          <div class="modal fade" id="addServiceModal" tabindex="-1" aria-labelledby="addServiceModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="addServiceModalLabel">Agregar Servicio</h5>
                  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form id="addServiceForm" action="php-add-service.php" method="POST">
                    <div class="form-group">
                      <label for="serviceName">Nombre del Servicio</label>
                      <input type="text" class="form-control" id="serviceName" name="serviceName" required>
                    </div>
                    <div class="form-group">
                      <label for="serviceIcon">Icono del Servicio</label>
                      <select class="form-select icon-select" id="serviceIcon" name="serviceIcon" required>
                        <option value='<i class="fi-wifi fs-lg me-2"></i>'>WiFi</option>
                        <option value='<i class="fi-dishwasher fs-lg me-2"></i>'>Lavavajillas</option>
                        <option value='<i class="fi-snowflake fs-lg me-2"></i>'>Aire acondicionado</option>
                        <option value='<svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-car-garage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M5 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M15 20a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" /><path d="M5 20h-2v-6l2 -5h9l4 5h1a2 2 0 0 1 2 2v4h-2m-4 0h-6m-6 -6h15m-6 0v-5" /><path d="M3 6l9 -4l9 4" /></svg>'>Lugar de estacionamiento</option>
                        <option value='<i class="fi-washing-machine fs-lg me-2"></i>'>Lavandería</option>
                        <option value='<i class="fi-iron fs-lg me-2"></i>'>Plancha</option>
                        <option value='<i class="fi-video fs-lg me-2"></i>'>Cámaras de seguridad</option>
                        <option value='<i class="fi-no-smoking fs-lg me-2"></i>'>Prohibido fumar</option>
                        <option value='<i class="fi-paw fs-lg me-2"></i>'>Se permiten mascotas</option>
                        <option value='<i class="fi-coffee"></i>'>Café</option>
                        <option value='<i class="fi-food"></i>'>Comida</option>
                        <option value='<i class="fi-fork-knife"></i>'>Cuchara y Tenedor</option>
                        <option value='<i class="fi-shower"></i>'>Ducha</option>
                        <option value='<i class="fi-washing-machine"></i>'>Lavadora</option>
                        <option value='<i class="fi-wheelchair"></i>'>Accesibilidad</option>
                        <option value='<svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-massage"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 17m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M9 5m-1 0a1 1 0 1 0 2 0a1 1 0 1 0 -2 0" /><path d="M4 22l4 -2v-3h12" /><path d="M11 20h9" /><path d="M8 14l3 -2l1 -4c3 1 3 4 3 6" /></svg>'>Masajes</option>
                        <option value='<svg  xmlns="http://www.w3.org/2000/svg"  width="18"  height="18"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1.5"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-pool"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M2 20a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1" /><path d="M2 16a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1" /><path d="M15 12v-7.5a1.5 1.5 0 0 1 3 0" /><path d="M9 12v-7.5a1.5 1.5 0 0 0 -3 0" /><path d="M15 5l-6 0" /><path d="M9 10l6 0" /></svg>'>Piscina</option>
                        <option value='<i class="fi-check-circle"></i>'>Icono default para otros</option>
                      </select>

                    </div>
                    <button type="submit" class="btn btn-dark w-100 mt-3 rounded-pill">Guardar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>



          <?php
          // Obtener los servicios de la base de datos
          $sql = "SELECT * FROM services_rent";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
              $serviceId = htmlspecialchars($row['services_rent_id'], ENT_QUOTES, 'UTF-8');
              $serviceName = htmlspecialchars($row['services_rent_name'], ENT_QUOTES, 'UTF-8');
              $serviceIcon = $row['services_rent_icon_svg']; // SVG content is already safe

              echo "
        <div class=\"col-12 d-sm-flex align-items-center mt-2 shadow\">
            <article class=\"card w-100\">
                <div class=\"row g-4\">
                    <div class=\"col-sm-3 col-md-2 d-flex justify-content-center align-items-center\">
                        <div class=\"service-icon\">
                            $serviceIcon
                        </div>
                    </div>
                    <div class=\"col-sm-7 col-md-8 align-items-center\">
                        <div class=\"card-body d-flex justify-content-between p-2 py-sm-2\">
                            <div class=\"position-relative align-items-center\">
                                <span class=\"h6 mb-0 mt-2\">$serviceName</span>
                            </div>
                            <div class=\"text-end\">
                                <form action=\"delete_service.php\" method=\"POST\" onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este servicio?');\">
                                    <input type=\"hidden\" name=\"service_id\" value=\"$serviceId\">
                                    <button type=\"submit\" class=\"btn btn-outline-danger\">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </article>
        </div>";
            }
          } else {
            echo "<p>No hay servicios disponibles.</p>";
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
  <script src="../uixsoftware/assets/js/theme.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>