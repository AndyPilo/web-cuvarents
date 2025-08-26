<?php
include '../uixsoftware/config/config.php';

session_start();
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
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

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <!-- Favicon -->
  <link rel="icon" href="/uixsoftware/assets/img/favicon-32x32.png" type="image/png">

  <!-- Theme switcher (color modes) -->
  <script src="../uixsoftware/assets/js/theme-switcher.js"></script>
  <link href="../uixsoftware/assets/fonts/inter-variable-latin.woff2" as="font" type="font/woff2" crossorigin="">
  <link rel="stylesheet" href="../uixsoftware/assets/css/finder-icons.min.css">
  <link href="../uixsoftware/assets/fonts/finder-icons.woff2" as="font" type="font/woff2" crossorigin="">
  <link rel="stylesheet" href="../uixsoftware/assets/css/swiper-bundle.min.css">
  <link rel="stylesheet" href="../uixsoftware/assets/css/glightbox.min.css">
  <link rel="stylesheet" href="../uixsoftware/assets/css/choices.min.css">
  <link rel="stylesheet" href="../uixsoftware/assets/css/nouislider.min.css">
  <link rel="preload" href="../uixsoftware/assets/css/theme.min.css" as="style">
  <link rel="stylesheet" href="../uixsoftware/assets/css/theme.min.css" id="theme-styles">
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


  <?php
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT account_id, account_password, account_username, account_prefix_phone, account_number_phone, account_email, account_rango FROM Accounts WHERE account_email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      if (password_verify($password, $row['account_password'])) {

        echo "Hasta aqui todo bien";
        // La contraseña es correcta
        $_SESSION['account_id'] = $row['account_id'];
        $_SESSION['account_username'] = $row['account_username'];
        $_SESSION['account_prefix_phone'] = $row['account_prefix_phone'];
        $_SESSION['account_number_phone'] = $row['account_number_phone'];
        $_SESSION['account_email'] = $row['account_email'];
        $_SESSION['account_rango'] = $row['account_rango'];

        if ($row['account_rango'] == 1) {
          echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Inicio de sesión exitoso',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location = '../'; // Redireccionar al perfil
                        });
                      </script>";
        } elseif ($row['account_rango'] == 99) {
          echo "<script>
                        Swal.fire({
                            icon: 'success',
                            title: 'Inicio de sesión exitoso',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(function() {
                            window.location = '../'; // Redireccionar al dashboard
                        });
                      </script>";
        }
      } else {
        // Contraseña incorrecta
        echo "<script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Contraseña incorrecta!'
                    });
                  </script>";
      }
    } else {
      // El usuario no existe
      echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Correo electrónico no encontrado!'
                });
              </script>";
    }
  }
  $conn->close();
  ?>

  <!-- Page content -->
  <main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width: 1920px">
    <div class="d-lg-flex">

      <!-- Login form + Footer -->
      <div class="d-flex flex-column min-vh-100 w-100 py-4 mx-auto me-lg-5" style="max-width: 416px">

        <!-- Logo -->
        <header class="navbar px-0 pb-4 mt-n2 mt-sm-0 mb-2 mb-md-3 mb-lg-4">
          <a class="navbar-brand" href="../">
            <span class="me-2">
              <img src="../uixsoftware/assets/img/logo.png" width="80" alt="Logo blanco de cuvarents">
            </span>
            CuvaRents
          </a>
        </header>

        <h1 class="h2 mt-auto">Bienvenido</h1>
        <div class="nav fs-sm mb-4">
          ¿No tienes una cuenta?
          <a class="nav-link text-decoration-underline p-0 ms-2" href="signup.php">Crear una cuenta</a>
        </div>

        <form class="needs-validation" novalidate="" action="login" method="post">
          <div class="position-relative mb-4">
            <input type="email" class="form-control form-control-lg" name="email" placeholder="Correo electrónico" required="">
            <div class="invalid-tooltip bg-transparent py-0">Enter a valid email address!</div>
          </div>
          <div class="mb-4">
            <div class="password-toggle">
              <input type="password" class="form-control form-control-lg" name="password" placeholder="Contraseña" required="">
              <div class="invalid-tooltip bg-transparent py-0">Password is incorrect!</div>
              <label class="password-toggle-button fs-lg" aria-label="Show/hide password">
                <input type="checkbox" class="btn-check"></label>
            </div>
          </div>
          <button type="submit" class="btn btn-lg btn-info w-100">Inicia sesión</button>
        </form>

        <!-- Footer -->
        <footer class="mt-auto">
          <div class="nav mb-4">
            <a class="nav-link text-decoration-underline p-0" href="help-topics-v1.html">¿Necesitas ayuda?</a>
          </div>
          <div class="text-center pt-4 pb-md-2">
            <p class="text-body-secondary fs-sm mb-0">© 2025 CuvaRents. All rights reserved. Made by <a class="text-body fw-medium text-decoration-none hover-effect-underline" href="https://www.uixsoftware.com/" target="_blank" rel="noreferrer">Uixsoftware</a></p>
          </div>
        </footer>
      </div>


      <!-- Cover image visible on screens > 992px wide (lg breakpoint) -->
      <div class="d-none d-lg-block w-100 py-4 ms-auto" style="max-width: 1034px">
        <div class="d-flex flex-column justify-content-end h-100 bg-info-subtle rounded-5" style="background-image: url(../uixsoftware/assets/img/login.jpg); background-size: cover;">
        </div>
      </div>
    </div>
  </main>


  <!-- Vendor scripts -->
  <script src="../uixsoftware/assets/js/swiper-bundle.min.js"></script>
  <script src="../uixsoftware/assets/js/glightbox.min.js"></script>
  <script src="../uixsoftware/assets/js/choices.min.js"></script>
  <script src="../uixsoftware/assets/js/nouislider.min.js"></script>

  <!-- Bootstrap + Theme scripts -->
  <script src="../uixsoftware/assets/js/theme.min.js"></script>


</body>

</html>