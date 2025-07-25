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

          <div class="d-flex justify-content-between pb-5">

            <h1 class="h2 mb-0">Reservas</h1>

            <!-- Botón para abrir el modal -->
            <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#addGestorModal">
              Agregar Gestor
            </button>

            <!-- Modal para agregar gestores -->
            <div class="modal fade" id="addGestorModal" tabindex="-1" aria-labelledby="addGestorModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="addGestorModalLabel">Agregar Gestor</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <form id="addGestorForm" action="php-add-gestor.php" method="POST">
                      <div class="form-group">
                        <label for="nombre">Nombre del Gestor</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" required>
                      </div>
                      <div class="form-group">
                        <label for="telefono">Teléfono</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                      </div>
                      <button type="submit" class="btn btn-dark w-100 mt-3 rounded-pill">Guardar</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>


          </div>



          <h3>Gestores</h3>
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