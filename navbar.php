<?php
include './uixsoftware/config/config.php';
session_start();

// Lógica para cerrar sesión
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  session_destroy();
  header("Location: ./"); // Redirige a la página de inicio de sesión después de cerrar la sesión
  exit();
}
// Asumimos que los datos del usuario están guardados en la sesión
$nombre = $_SESSION['account_username'] ?? 'Nombre';
$apellido = ''; // Puedes almacenar y recuperar el apellido según tu estructura de datos
$email = $_SESSION['account_email'] ?? 'Correo electrónico';
$telefono = (isset($_SESSION['account_prefix_phone']) && isset($_SESSION['account_number_phone'])) ? $_SESSION['account_prefix_phone'] . ' ' . $_SESSION['account_number_phone'] : 'Teléfono';
$rango = (isset($_SESSION['account_rango']) && $_SESSION['account_rango'] == 99) ? 'Administrador' : 'Miembro';
?>
<?php
$loggedIn = isset($_SESSION['account_id']);
$accountRango = $_SESSION['account_rango'] ?? null;
?>


    <!-- Navigation bar (Page header) -->
    <header class="navbar navbar-expand-lg bg-body navbar-sticky sticky-top z-fixed px-0" data-sticky-element="">
      <div class="container">

      <div>
        <!-- Mobile offcanvas menu toggler (Hamburger) -->
        <button type="button" class="navbar-toggler me-0 me-lg-0" data-bs-toggle="offcanvas" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar brand (Logo) -->
        <a class="navbar-brand py-1 py-md-2 py-xl-1 me-2 me-sm-n4 me-md-n5 me-lg-0" href="./">
          <span class="me-0">
          <img src="uixsoftware/assets/img/logo-white.png" class="rounded-circle me-2" width="60" alt="">
          </span>
          <span class="d-none d-md-block black-ops-one-regular">
          CuVaRents</span>
        </a></div>

        <!-- Main navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
        <nav class="offcanvas offcanvas-start" id="navbarNav" tabindex="-1" aria-labelledby="navbarNavLabel">
          <div class="offcanvas-header py-3">
            <h5 class="offcanvas-title" id="navbarNavLabel">Menú</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
          </div>
          <div class="offcanvas-body pt-2 pb-4 py-lg-0 mx-lg-auto">
            <ul class="navbar-nav position-relative">              
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="./">Inicio</a>
              </li>
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="./rents.php">Rentas</a>
              </li>
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="./about.php">Quienes somos?</a>
              </li>
              <li class="nav-item py-lg-2 me-lg-n2 me-xl-0">
                <a class="nav-link" href="./contact.php">Contactos</a>
              </li>
            </ul>
          </div>
        </nav>

        <!-- Button group -->
        <div class="d-flex gap-sm-1">

          <!-- Theme switcher (light/dark/auto) -->
          <div class="dropdown">
            <button type="button" class="theme-switcher btn btn-icon btn-outline-secondary fs-lg border-0 animate-scale" data-bs-toggle="dropdown" data-bs-display="dynamic" aria-expanded="false" aria-label="Toggle theme (light)">
              <span class="theme-icon-active d-flex animate-target">
                <i class="fi-sun"></i>
              </span>
            </button>
            <ul class="dropdown-menu start-50 translate-middle-x" style="--fn-dropdown-min-width: 9rem; --fn-dropdown-spacer: .5rem">
              <li>
                <button type="button" class="dropdown-item active" data-bs-theme-value="light" aria-pressed="true">
                  <span class="theme-icon d-flex fs-base me-2">
                    <i class="fi-sun"></i>
                  </span>
                  <span class="theme-label">Light</span>
                  <i class="item-active-indicator fi-check ms-auto"></i>
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item" data-bs-theme-value="dark" aria-pressed="false">
                  <span class="theme-icon d-flex fs-base me-2">
                    <i class="fi-moon"></i>
                  </span>
                  <span class="theme-label">Dark</span>
                  <i class="item-active-indicator fi-check ms-auto"></i>
                </button>
              </li>
              <li>
                <button type="button" class="dropdown-item" data-bs-theme-value="auto" aria-pressed="false">
                  <span class="theme-icon d-flex fs-base me-2">
                    <i class="fi-auto"></i>
                  </span>
                  <span class="theme-label">Auto</span>
                  <i class="item-active-indicator fi-check ms-auto"></i>
                </button>
              </li>
            </ul>
          </div>

          <div class="d-flex align-items-center gap-2">

         

        <!-- Verificar si el usuario ha iniciado sesión -->
        <?php if (!$loggedIn): ?>
   
            <a class="btn buttonx"  id="loginBtn" href="auth/login.php">
    Iniciar sesión
        </a>

            <a class="btn buttons d-none d-md-flex" id="signupBtn" href="auth/signup.php">
   <svg class="svgIcon" viewBox="0 0 512 512" height="1em" xmlns="http://www.w3.org/2000/svg"><path d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm50.7-186.9L162.4 380.6c-19.4 7.5-38.5-11.6-31-31l55.5-144.3c3.3-8.5 9.9-15.1 18.4-18.4l144.3-55.5c19.4-7.5 38.5 11.6 31 31L325.1 306.7c-3.2 8.5-9.9 15.1-18.4 18.4zM288 256a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z"></path></svg>
  Registrarse
        </a>
      
        <?php else: ?>
            <!-- Botones para usuarios autenticados -->

            <!-- Botones para usuarios autenticados -->
<div class="dropdown">
    <a class="rounded-circle bg-gradient-al" href="#" style="    padding: 8px 18px !important;" data-bs-toggle="dropdown" aria-expanded="false">
       
    </a>
    <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="?action=logout">Cerrar sesión</a></li>
    </ul>
</div>


            <?php if ($accountRango == 99): ?>
                <!-- Botón adicional para administradores -->
                <a class="btn btn-outline-secondary" href="./dashboard">Dashboard</a>
            <?php endif; ?>
        <?php endif; ?>

        </div>
      </div>
    </header>


    <style>
      /* From Uiverse.io by vinodjangid07 */ 
.buttons {
  width: 140px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  gap: 10px;
  background-color: rgb(20, 114, 255);
  border-radius: 30px;
  color: rgb(234, 247, 255);
  font-weight: 600;
  border: none;
  position: relative;
  cursor: pointer;
  transition-duration: .2s;
  box-shadow: 5px 5px 10px rgba(0, 0, 0, 0.116);
  padding-left: 8px;
  transition-duration: .5s;
}

.svgIcon {
  height: 25px;
  fill: #fff8f8 !important;
  transition-duration: 1.5s;
}

.bell path {
  fill: #fff8f8 !important;
}

.buttons:hover {
  color:rgb(167, 248, 255);
  background-color: rgb(20, 177, 255);
  transition-duration: .2s;
}

.buttons:active {
  transform: scale(0.97);
  transition-duration: .2s;
}

.buttons:hover .svgIcon {
  fill: rgb(167, 248, 255) !important;
  transform: rotate(250deg);
  transition-duration: 1.5s;
}








.buttonx {
  width: 130px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center !important;
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
  transition-duration: .5s;
}

.svgIconx {
  height: 25px;
  fill:rgb(167, 248, 255) !important;
  transition-duration: 1.5s;
}

.bell path {
  fill:rgb(167, 248, 255) !important;
}

.buttonx:hover {
  color:rgb(29, 45, 64);
  background-color: rgb(167, 248, 255);
  transition-duration: .2s;
}

.buttonx:active {
  transform: scale(0.97);
  transition-duration: .2s;
}

.buttonx:hover .svgIconx {
  fill: rgb(29, 45, 64) !important;
  transform: rotate(250deg);
  transition-duration: 1.5s;
}


    </style>