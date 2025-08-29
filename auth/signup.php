<?php
include '../uixsoftware/config/config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hashear la contraseña
  $phone_prefix = $_POST['phone_prefix'];
  $phone_number = $_POST['phone_number'];

  $sql = "INSERT INTO Accounts (account_username, account_email, account_password, account_prefix_phone, account_number_phone)
            VALUES ('$name', '$email', '$password', '$phone_prefix', '$phone_number')";

  if ($conn->query($sql) === TRUE) {
    header("Location: login");
    exit();
  } else {
    echo "Error: " . $sql . "<br>" . $conn->error;
  }

  $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en" data-bs-theme="light">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Meta tags -->
  <title>Signup</title>
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

  <!-- Page content -->
  <main class="content-wrapper w-100 px-3 ps-lg-5 pe-lg-4 mx-auto" style="max-width: 1920px">
    <div class="d-lg-flex">

      <!-- Login form + Footer -->
      <div class="d-flex flex-column min-vh-100 w-100 py-4 mx-auto me-lg-5" style="max-width: 416px">

        <!-- Logo -->
        <header class="navbar px-0 pb-4 mt-n2 mt-sm-0 mb-2 mb-md-3 mb-lg-4">
          <a class="navbar-brand" href="../">
            <span class="me-2">
              <img src="../uixsoftware/assets/img/logo.png" width="80" alt="Logo blanco de Cuvarents">
            </span>
            CuvaRents
          </a>
        </header>

        <h1 class="h2 mt-auto">Crear una cuenta</h1>
        <div class="nav fs-sm mb-3 mb-lg-4">
          Ya tengo una cuenta
          <a class="nav-link text-decoration-underline p-0 ms-2" href="login">Inicia sesión</a>
        </div>

        <!-- Form -->
        <form class="needs-validation" novalidate="" action="signup" method="post">
          <div class="position-relative mb-4">
            <label for="register-name" class="form-label">Nombre y Apellido</label>
            <input type="text" class="form-control form-control-lg" id="register-name" name="name" required="">
            <div class="invalid-tooltip bg-transparent py-0">Enter your name!</div>
          </div>
          <div class="position-relative mb-4">
            <label for="register-email" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control form-control-lg" id="register-email" name="email" required="">
            <div class="invalid-tooltip bg-transparent py-0">Enter a valid email address!</div>
          </div>
          <div class="mb-4">
            <label for="register-password" class="form-label">Contraseña</label>
            <div class="password-toggle">
              <input type="password" class="form-control form-control-lg" id="register-password" name="password" minlength="8" required="">
              <div class="invalid-tooltip bg-transparent py-0">Password does not meet the required criteria!</div>
              <label class="password-toggle-button fs-lg" aria-label="Show/hide password">
                <input type="checkbox" class="btn-check"></label>
            </div>
          </div>
          <div class="position-relative mb-4">
            <label for="register-prefix" class="form-label">Prefijo del Teléfono</label>
            <select class="form-select form-select-lg" id="register-prefix" name="phone_prefix" required="">
              <option value="+1">+1 - Estados Unidos / Canadá</option>
              <option value="+52">+52 - México</option>
              <option value="+53">+53 - Cuba</option>
              <option value="+54">+54 - Argentina</option>
              <option value="+55">+55 - Brasil</option>
              <option value="+56">+56 - Chile</option>
              <option value="+57">+57 - Colombia</option>
              <option value="+58">+58 - Venezuela</option>
              <option value="+51">+51 - Perú</option>
              <option value="+593">+593 - Ecuador</option>
              <option value="+591">+591 - Bolivia</option>
              <option value="+598">+598 - Uruguay</option>
              <option value="+595">+595 - Paraguay</option>
              <option value="+506">+506 - Costa Rica</option>
              <option value="+507">+507 - Panamá</option>
              <option value="+502">+502 - Guatemala</option>
              <option value="+503">+503 - El Salvador</option>
              <option value="+504">+504 - Honduras</option>
              <option value="+505">+505 - Nicaragua</option>
              <option value="+506">+506 - Costa Rica</option>
              <option value="+507">+507 - Panamá</option>
              <option value="+34">+34 - España</option>
              <option value="+44">+44 - Reino Unido</option>
              <option value="+33">+33 - Francia</option>
              <option value="+49">+49 - Alemania</option>
              <option value="+39">+39 - Italia</option>
              <option value="+7">+7 - Rusia</option>
              <option value="+86">+86 - China</option>
              <option value="+91">+91 - India</option>
              <option value="+81">+81 - Japón</option>
              <option value="+82">+82 - Corea del Sur</option>
              <option value="+61">+61 - Australia</option>
              <option value="+64">+64 - Nueva Zelanda</option>
              <option value="+27">+27 - Sudáfrica</option>
              <option value="+20">+20 - Egipto</option>
              <option value="+234">+234 - Nigeria</option>
              <option value="+966">+966 - Arabia Saudita</option>
              <option value="+971">+971 - Emiratos Árabes Unidos</option>
            </select>
            <div class="invalid-tooltip bg-transparent py-0">Select a phone prefix!</div>
          </div>
          <div class="position-relative mb-4">
            <label for="register-phone" class="form-label">Número de Teléfono</label>
            <input type="tel" class="form-control form-control-lg" id="register-phone" name="phone_number" required="">
            <div class="invalid-tooltip bg-transparent py-0">Enter a valid phone number!</div>
          </div>
          <div class="d-flex flex-column gap-2 mb-4">
            <div class="form-check">
              <input type="checkbox" class="form-check-input" id="privacy" required="">
              <label for="privacy" class="form-check-label">He leído y acepto la <a class="text-dark-emphasis" href="#!">Política de Privacidad</a></label>
            </div>
          </div>
          <button type="submit" class="btn btn-lg btn-info w-100">
            Crear una cuenta
            <i class="fi-chevron-right fs-lg ms-1 me-n1"></i>
          </button>
        </form>



        <!-- Footer -->
        <footer class="mt-auto">
          <div class="nav mb-4">
          </div>
          <div class="text-center pt-4 pb-md-2">
            <p class="text-body-secondary fs-sm mb-0">© 2025 CuvaRents. All rights reserved. Made by <a class="text-body fw-medium text-decoration-none hover-effect-underline" href="https://www.uixsoftware.com/" target="_blank" rel="noreferrer">Uixsoftware</a></p>
          </div>
        </footer>
      </div>

      <!-- Cover image visible on screens > 992px wide (lg breakpoint) -->
      <div class="d-none d-lg-block w-100 py-4 ms-auto" style="max-width: 1034px">
        <div class="d-flex flex-column justify-content-end h-100 bg-info-subtle rounded-5" style="background-image: url(../uixsoftware/assets/img/signup.jpg); background-size: cover; background-position: center;">
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