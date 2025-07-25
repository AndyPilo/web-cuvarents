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
          <h1 class="h2 pb-2 pb-lg-3">Configuración de la web</h1>

          <!-- Nav pills -->
          <div class="nav overflow-x-auto mb-3">
            <ul class="nav nav-pills flex-nowrap gap-2 pb-2 mb-1" role="tablist">
              <li class="nav-item me-1" role="presentation">
                <button type="button" class="nav-link text-nowrap active" id="personal-info-tab" data-bs-toggle="pill" data-bs-target="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">
                  Información personal
                </button>
              </li>
              <li class="nav-item me-1" role="presentation">
                <button class="nav-link text-nowrap" id="security-tab" data-bs-toggle="pill" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false" tabindex="-1">
                  Configuración de reservas
                </button>
              </li>
            </ul>
          </div>

          <div class="tab-content">

            <!-- Personal info tab -->
            <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
              <div class="vstack gap-4">
                <!-- Settings form -->
                <form class="needs-validation" novalidate="">
                  <div class="row row-cols-1 row-cols-sm-2 g-4 mb-4">
                    <div class="col-12 position-relative">
                      <label for="fn" class="form-label fs-base">Nombre y Apellido *</label>
                      <input type="text" class="form-control form-control-lg" id="fn" value="<?php echo $nombre; ?>" required="" disabled>
                      <div class="invalid-tooltip bg-transparent p-0">Enter your first name!</div>
                    </div>
                    <div class="col position-relative">
                      <label for="email" class="form-label d-flex align-items-center fs-base">Dirección de correo electrónico *</label>
                      <input type="email" class="form-control form-control-lg" id="email" value="<?php echo $email; ?>" required="" disabled>
                      <div class="invalid-tooltip bg-transparent p-0">Enter a valid email address!</div>
                    </div>
                    <div class="col position-relative">
                      <label for="phone" class="form-label d-flex align-items-center fs-base">Número de teléfono *</label>
                      <input type="tel" class="form-control form-control-lg" id="phone" value="<?php echo $telefono; ?>" placeholder="(___) ___-____" required="" disabled>
                      <div class="invalid-tooltip bg-transparent p-0">Enter a valid phone number!</div>
                    </div>
                  </div>
                  <div class="position-relative mb-4">
                    <label for="rango" class="form-label fs-base">Rango *</label>
                    <input type="text" class="form-control form-control-lg" id="rango" value="<?php echo $rango; ?>" disabled>
                  </div>
                </form>
              </div>
            </div>


            <!-- Password and security tab -->
            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
              <p class="mb-sm-4">Su dirección de correo electrónico actual es <span class="fw-medium h6"><?php echo $email; ?></span></p>

              <div class="table-responsive">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre</th>
                      <th>Teléfono</th>
                      <th>Activo</th>
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php

                    $sql = "SELECT * FROM Gestores";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                      while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['id'] . "</td>";
                        echo "<td>" . $row['nombre'] . "</td>";
                        echo "<td>" . $row['telefono'] . "</td>";
                        echo "<td>" . ($row['activo'] ? 'Sí' : 'No') . "</td>";
                        echo "<td class='d-flex gap-2'>";
                        if (!$row['activo']) {
                          echo "<form action='php-activar-gestor.php' method='POST' onsubmit=\"return confirm('¿Estás seguro de que deseas activar este gestor?');\">";
                          echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                          echo "<button type='submit' class='btn btn-success p-2'>Activar</button>";
                          echo "</form>";
                        }
                        echo "<form action='php-eliminar-gestor.php' method='POST' onsubmit=\"return confirm('¿Estás seguro de que deseas eliminar este gestor?');\">";
                        echo "<input type='hidden' name='id' value='" . $row['id'] . "'>";
                        if (!$row['activo']) {
                          echo '<button type="submit" class="btn btn-danger p-2"><svg  xmlns="http://www.w3.org/2000/svg"  width="16"  height="16"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-trash"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 7l16 0" /><path d="M10 11l0 6" /><path d="M14 11l0 6" /><path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" /><path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" /></svg></button>';
                        } else {
                          echo "<button type='submit' class='btn btn-danger p-2' disabled>Eliminar</button>";
                        }
                        echo "</form>";
                        echo "</td>";
                        echo "</tr>";
                      }
                    } else {
                      echo "<tr><td colspan='5'>No hay gestores disponibles.</td></tr>";
                    }

                    $conn->close();
                    ?>
                  </tbody>
                </table>
              </div>


            </div>


            <!-- Notification settings tab -->
            <div class="tab-pane fade" id="notifications" role="tabpanel" aria-labelledby="notifications-tab">

              <!-- Item -->
              <div class="d-sm-flex align-items-center justify-content-between border-bottom pb-4">
                <div class="me-4 mb-md-2">
                  <h3 class="h6 mb-2">New rental alerts</h3>
                  <p class="fs-sm pb-1 pb-sm-0 mb-sm-0">New rentals that match your <a class="text-body" href="account-favorites.html">Favorites</a></p>
                </div>
                <div class="d-flex gap-4 gap-xl-5 mb-md-2">
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="email-1" class="form-check-label">Email</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="email-1" checked="">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="phone-1" class="form-check-label mb-1">Phone</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="phone-1">
                  </div>
                </div>
              </div>

              <!-- Item -->
              <div class="d-sm-flex align-items-center justify-content-between border-bottom py-4">
                <div class="me-4 my-md-2">
                  <h3 class="h6 mb-2">Rental status updates</h3>
                  <p class="fs-sm pb-1 pb-sm-0 mb-sm-0">Updates like price changes and off-market status on your <a class="text-body" href="account-favorites.html">Favorites</a></p>
                </div>
                <div class="d-flex gap-4 gap-xl-5 my-md-2">
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="email-2" class="form-check-label">Email</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="email-2" checked="">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="phone-2" class="form-check-label mb-1">Phone</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="phone-2">
                  </div>
                </div>
              </div>

              <!-- Item -->
              <div class="d-sm-flex align-items-center justify-content-between border-bottom py-4">
                <div class="me-4 my-md-2">
                  <h3 class="h6 mb-2">Finder recommendations</h3>
                  <p class="fs-sm pb-1 pb-sm-0 mb-sm-0">Rentals we think you'll like. These recommendations may be slightly outside your search criteria</p>
                </div>
                <div class="d-flex gap-4 gap-xl-5 my-md-2">
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="email-3" class="form-check-label">Email</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="email-3">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="phone-3" class="form-check-label mb-1">Phone</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="phone-3">
                  </div>
                </div>
              </div>

              <!-- Item -->
              <div class="d-sm-flex align-items-center justify-content-between border-bottom py-4">
                <div class="me-4 my-md-2">
                  <h3 class="h6 mb-2">Featured news</h3>
                  <p class="fs-sm pb-1 pb-sm-0 mb-sm-0">News and tips you may be interested in</p>
                </div>
                <div class="d-flex gap-4 gap-xl-5 my-md-2">
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="email-4" class="form-check-label">Email</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="email-4">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="phone-4" class="form-check-label mb-1">Phone</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="phone-4" checked="">
                  </div>
                </div>
              </div>

              <!-- Item -->
              <div class="d-sm-flex align-items-center justify-content-between border-bottom py-4">
                <div class="me-4 my-md-2">
                  <h3 class="h6 mb-2">Finder extras</h3>
                  <p class="fs-sm pb-1 pb-sm-0 mb-sm-0">Occasional notifications about new features to make finding the perfect rental easy</p>
                </div>
                <div class="d-flex gap-4 gap-xl-5 my-md-2">
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="email-5" class="form-check-label">Email</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="email-5" checked="">
                  </div>
                  <div class="form-check form-switch d-flex align-items-center ps-0 mb-0">
                    <label for="phone-5" class="form-check-label mb-1">Phone</label>
                    <input type="checkbox" class="form-check-input ms-2" role="switch" id="phone-5" checked="">
                  </div>
                </div>
              </div>
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
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</body>

</html>