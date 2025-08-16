<?php
include '../uixsoftware/config/config.php';
session_start();

// Lógica para cerrar sesión
if (isset($_GET['action']) && $_GET['action'] == 'logout') {
  session_destroy();
  header("Location: ../auth/login.php"); // Redirige a la página de inicio de sesión después de cerrar la sesión
  exit();
}

// Verificar si el usuario ha iniciado sesión
if (!isset($_SESSION['account_id'])) {
  // Si no hay sesión activa, redirige al login
  header("Location: ../auth/login.php");
  exit();
}

$loggedIn = isset($_SESSION['account_id']);
$accountRango = $_SESSION['account_rango'] ?? null;
// Asumimos que los datos del usuario están guardados en la sesión
$nombre = $_SESSION['account_username'] ?? 'Nombre';
$apellido = ''; // Puedes almacenar y recuperar el apellido según tu estructura de datos
$email = $_SESSION['account_email'] ?? 'Correo electrónico';
$telefono = $_SESSION['account_prefix_phone'] . ' ' . $_SESSION['account_number_phone'];
$rango = ($_SESSION['account_rango'] == 99) ? 'Administrador' : 'Miembro';
?>

<?php
// Obtener los servicios de la base de datos
$sql = "SELECT services_rent_id, services_rent_name, services_rent_icon_svg FROM services_rent";
$result = $conn->query($sql);

$checkboxes = '';
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $checkboxes .= '<div class="col-12 col-md-6 checkbox-wrapper-16">
            <label class="checkbox-wrapper">
                <input class="checkbox-input" type="checkbox" value="' . htmlspecialchars($row['services_rent_id'], ENT_QUOTES, 'UTF-8') . '" id="service_' . htmlspecialchars($row['services_rent_id'], ENT_QUOTES, 'UTF-8') . '" name="services[]">
                <span class="checkbox-tile">
                    <span class="checkbox-icon">' . $row['services_rent_icon_svg'] . '</span>
                    <span class="small">' . htmlspecialchars($row['services_rent_name'], ENT_QUOTES, 'UTF-8') . '</span>
                </span>
            </label>
        </div>';
  }
} else {
  $checkboxes .= '<p>No hay servicios disponibles.</p>';
}
?>





<nav class="d-lg-none mb-5 px-0">
  <div class="d-flex justify-content-between">

    <a class="navbar-brand " href="./">
      <span class="me-0">
        <img src="../uixsoftware/assets/img/logo.png" style="margin-top: -20px; margin-bottom: -20px;" width="80" alt="Logo blanco de Cuvarents">
      </span>
      <span class="h4 mb-0 fw-bold">
        CuvaRents</span>
    </a>

    <!-- Botón para abrir el Offcanvas en pantallas pequeñas -->
    <button class="btn btn-outline-secondary rounded-pill" type="button" data-bs-toggle="offcanvas" data-bs-target="#accountSidebar" aria-controls="accountSidebar">
      <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M7 6h10" />
        <path d="M4 12h16" />
        <path d="M7 12h13" />
        <path d="M7 18h10" />
      </svg>
    </button>

  </div>
</nav>

<!-- Sidebar navigation that turns into offcanvas on screens < 992px wide (lg breakpoint) -->
<aside class="col-lg-3">
  <div class="offcanvas-lg offcanvas-start pe-lg-3 pe-xl-4" id="accountSidebar">

    <!-- Header -->
    <div class="offcanvas-header d-block py-3 p-lg-0">
      <div class="d-flex flex-row flex-lg-column align-items-center align-items-lg-start">
        <div class="flex-shrink-0 border rounded-circle overflow-hidden bg-gradient-al" style="width: 64px; height: 64px"></div>
        <div class="pt-lg-3 ps-3 ps-lg-0">
          <h6 class="mb-1"><?php echo $nombre; ?></h6>
          <p class="fs-sm mb-0"><?php echo $email; ?></p>
        </div>
      </div>
    </div>


    <!-- Body (Navigation) -->
    <div class="offcanvas-body d-block pt-2 pt-lg-4 pb-lg-0">
      <nav class="list-group list-group-borderless">
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="./">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-layout-board">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M4 4m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
            <path d="M4 9h8" />
            <path d="M12 15h8" />
            <path d="M12 4v16" />
          </svg>
          Dashboard
        </a>
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="rents">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-home-edit">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 21v-6a2 2 0 0 1 2 -2h2c.645 0 1.218 .305 1.584 .78" />
            <path d="M20 11l-8 -8l-9 9h2v7a2 2 0 0 0 2 2h4" />
            <path d="M18.42 15.61a2.1 2.1 0 0 1 2.97 2.97l-3.39 3.42h-3v-3l3.42 -3.39z" />
          </svg>
          Gestionar rentas
        </a>
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="reviews">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-message-circle-user">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M19 17m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
            <path d="M22 22a2 2 0 0 0 -2 -2h-2a2 2 0 0 0 -2 2" />
            <path d="M12.454 19.97a9.9 9.9 0 0 1 -4.754 -.97l-4.7 1l1.3 -3.9c-2.324 -3.437 -1.426 -7.872 2.1 -10.374c3.526 -2.501 8.59 -2.296 11.845 .48c1.667 1.423 2.596 3.294 2.747 5.216" />
          </svg>
          Recomendaciones
        </a>
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="comodities">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-wifi">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M12 18l.01 0" />
            <path d="M9.172 15.172a4 4 0 0 1 5.656 0" />
            <path d="M6.343 12.343a8 8 0 0 1 11.314 0" />
            <path d="M3.515 9.515c4.686 -4.687 12.284 -4.687 17 0" />
          </svg>
          Servicios de rentas
        </a>
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="reservas">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-circle-dashed-check">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8.56 3.69a9 9 0 0 0 -2.92 1.95" />
            <path d="M3.69 8.56a9 9 0 0 0 -.69 3.44" />
            <path d="M3.69 15.44a9 9 0 0 0 1.95 2.92" />
            <path d="M8.56 20.31a9 9 0 0 0 3.44 .69" />
            <path d="M15.44 20.31a9 9 0 0 0 2.92 -1.95" />
            <path d="M20.31 15.44a9 9 0 0 0 .69 -3.44" />
            <path d="M20.31 8.56a9 9 0 0 0 -1.95 -2.92" />
            <path d="M15.44 3.69a9 9 0 0 0 -3.44 -.69" />
            <path d="M9 12l2 2l4 -4" />
          </svg>
          Sistema de Reservas
        </a>
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="profile">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-settings-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M19.875 6.27a2.225 2.225 0 0 1 1.125 1.948v7.284c0 .809 -.443 1.555 -1.158 1.948l-6.75 4.27a2.269 2.269 0 0 1 -2.184 0l-6.75 -4.27a2.225 2.225 0 0 1 -1.158 -1.948v-7.285c0 -.809 .443 -1.554 1.158 -1.947l6.75 -3.98a2.33 2.33 0 0 1 2.25 0l6.75 3.98h-.033z" />
            <path d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0" />
          </svg>
          Configuraciones
        </a>
        <a class="list-group-item list-group-item-action rounded-pill d-flex align-items-center" href="../">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-logout-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
            <path d="M15 12h-12l3 -3" />
            <path d="M6 15l-3 -3" />
          </svg>
          Ir al sitio web
        </a>
      </nav>
      <nav class="pt-3 d-flex">
        <a class=" btn btn-danger rounded-pill d-flex align-items-center" href="?action=logout">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler me-2 icons-tabler-outline icon-tabler-logout-2">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
            <path d="M15 12h-12l3 -3" />
            <path d="M6 15l-3 -3" />
          </svg>
          Cerrar sesión
        </a>
      </nav>
    </div>
  </div>
</aside>









<!-- Modal -->
<div class="modal" id="addRentalModal">
  <div class="modal-dialog modal-lg px-3">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addRentalModalLabel">Agregar Renta</h5>
      </div>
      <div class="modal-body">
        <form id="addRentalForm" action="php-add-rent.php" method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="rentalTitle">Nombre de la Renta</label>
            <input type="text" class="form-control" id="rentalTitle" name="rentalTitle" required>
          </div>
          <div class="form-group">
            <label for="rentalDescription">Descripción</label>
            <textarea class="form-control" id="rentalDescription" name="rentalDescription" rows="3" required></textarea>
          </div>

          <div class="form-group">
            <label for="rentalCategory">Categoría de renta</label>
            <select class="form-select" id="rentalCategory" name="rentalCategory" required>
              <option value="" selected>Seleccione</option>
              <option value="Casas de lujo">Casas de lujo</option>
              <option value="Casas en la playa">Casas en la playa</option>
              <option value="Casas y Apartamentos por largas y cortas estancias">Casas y Apartamentos por largas y cortas estancias</option>
              <option value="Casas y Alojamientos vacacionales">Casas y Alojamientos vacacionales</option>
            </select>
          </div>


          <div class="form-row row">
            <div class="form-group col-12 col-md-6">
              <label for="rentalPrice">Precio</label>
              <input type="number" class="form-control" id="rentalPrice" name="rentalPrice" required>
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="rentalPriceType">Tipo de Precio</label>
              <select class="form-select" id="rentalPriceType" name="rentalPriceType" required>
                <option value="" selected>Seleccione</option>
                <option value="día / habitación">Día/Habitación</option>
                <option value="semanal / habitación">Semanal/Habitación</option>
                <option value="mensual / habitación">Mensual/Habitación</option>

                <option value="día / casa">Día/Casa</option>
                <option value="semanal / casa">Semanal/Casa</option>
                <option value="mensual / casa">Mensual/Casa</option>
              </select>
            </div>
          </div>
          <div class="form-group d-none">
            <label for="rentalLocation">Ubicación</label>
            <input type="text" class="form-control" id="rentalLocation" name="rentalLocation">
          </div>
          <div class="form-row row">
            <div class="form-group col-12 col-md-6">
              <label for="habitaciones">Habitaciones</label>
              <input type="number" name="habitaciones" class="form-control" id="habitaciones">
            </div>
            <div class="form-group col-12 col-md-6">
              <label for="capacidad">Capacidad de renta</label>
              <input type="number" name="capacidad" class="form-control" id="capacidad">
            </div>
          </div>
          <div class="form-row row ubi-content">
            <div class="form-group col-12 col-md-6">
              <label for="provincia1">Provincia</label>
              <select class="form-select" id="provincia1" name="provincia1" onchange="cambiarMunicipios('provincia1', 'municipio1')" tabindex="-1">
                <option value="" selected>Provincia</option>
                <option value="Pinar del Río">Pinar del Río</option>
                <option value="Artemisa">Artemisa</option>
                <option value="La Habana">La Habana</option>
                <option value="Mayabeque">Mayabeque</option>
                <option value="Matanzas">Matanzas</option>
                <option value="Cienfuegos">Cienfuegos</option>
                <option value="Villa Clara">Villa Clara</option>
                <option value="Sancti Spíritus">Sancti Spíritus</option>
                <option value="Ciego de Ávila">Ciego de Ávila</option>
                <option value="Camagüey">Camagüey</option>
                <option value="Las Tunas">Las Tunas</option>
                <option value="Granma">Granma</option>
                <option value="Las Tunas">Las Tunas</option>
                <option value="Holguín">Holguín</option>
                <option value="Santiago de Cuba">Santiago de Cuba</option>
                <option value="Guantánamo">Guantánamo</option>
              </select>
            </div>

            <div class="form-group col-12 col-md-6">
              <label for="municipio1">Zonas</label>
              <select class="form-select" name="municipio1" id="municipio1" tabindex="-1">
                <option value="" selected>Seleccione una zona</option>
                <option value="Viñales">Viñales</option>
                <option value="La Habana">La Habana</option>
                <option value="Vedado">Vedado</option>
                <option value="Playa">Playa</option>
                <option value="Siboney">Siboney</option>
                <option value="Miramar">Miramar</option>
                <option value="Santa Fe">Santa Fe</option>
                <option value="Centro Habana">Centro Habana</option>
                <option value="Habana Vieja">Habana Vieja</option>
                <option value="Guanabo">Guanabo</option>
                <option value="Boca Ciega">Boca Ciega</option>
                <option value="Brisas del Mar">Brisas del Mar</option>
                <option value="Santa Maria">Santa María</option>
                <option value="Varadero">Varadero</option>
                <option value="Boca Camarioca">Boca Camarioca</option>
                <option value="Cienaga de Zapata">Ciénaga de Zapata</option>
                <option value="Santa Marta">Santa Marta</option>
                <option value="Trinidad">Trinidad</option>
                <option value="Guarda la Vaca">Guarda la Vaca</option>
              </select>
            </div>



          </div>
          <div class="form-group">
            <label for="typeTimeRent">Tipo de Renta</label>
            <select class="form-select" id="typeTimeRent" name="typeTimeRent" required>
              <option value="" selected>Seleccione</option>
              <option value="Tiempo limitado">Tiempo limitado</option>
              <option value="Tiempo indefinido">Tiempo indefinido</option>
            </select>
          </div>
          <div class="form-group services-content">
            <label class="mb-3">Servicios</label>
            <div class="row g-2" id="servicesCheckboxes">
              <!-- Aquí se cargarán los checkboxes con los servicios -->
            </div>
          </div>
          <div class="containerx images-content" style="margin-top: 70px;">
            <div class="folder">
              <div class="front-side">
                <div class="tip"></div>
                <div class="cover"></div>
              </div>
              <div class="back-side cover"></div>
            </div>
            <label class="custom-file-upload">
              <input type="file" class="form-control-file title" id="rentalImages" name="rentalImages[]" multiple accept="image/*" onchange="previewImages(event)" />
              Agregar fotos de renta
            </label>
            <div id="imagePreview" class="d-flex flex-wrap mt-2">
              <!-- Aquí se mostrarán las previsualizaciones de las imágenes -->
            </div>
          </div>
          <button type="submit" class="btn btn-dark w-100 mt-3 rounded-pill">Guardar</button>
        </form>
      </div>
    </div>
  </div>
</div>




<script>
  document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM completamente cargado');

    // Definir provinciasMunicipios en el ámbito global
    const provinciasMunicipios = {
      'Pinar del Río': [
        'Viñales',
        'Consolación del Sur',
        'Guane',
        'La Palma',
        'Los Palacios',
        'Mantua',
        'Minas de Matahambre',
        'Pinar del Río',
        'San Juan y Martínez',
        'San Luis',
        'Sandino'
      ],
      'La Habana': [
        'Plaza de la Revolución',
        'Centro Habana',
        'Habana Vieja',
        'Cerro',
        'Cotorro',
        'Diez de Octubre',
        'Guanabacoa',
        'Habana del Este',
        'La Lisa',
        'Marianao',
        'Playa',
        'Regla',
        'San Miguel del Padrón',
        'Arroyo Naranjo',
        'Boyeros'
      ],
      'Santiago de Cuba': [
        'Contramaestre',
        'Guamá',
        'II Frente',
        'Mella',
        'Palma Soriano',
        'San Luis',
        'Santiago de Cuba',
        'Songo-La Maya',
        'Tercer Frente'
      ],
      'Matanzas': [
        'Calimete',
        'Cárdenas',
        'Ciénaga de Zapata',
        'Colón',
        'Jagüey Grande',
        'Jovellanos',
        'Limonar',
        'Los Arabos',
        'Martí',
        'Matanzas',
        'Pedro Betancourt',
        'Perico',
        'Unión de Reyes',
        'Varadero',
        'Santa Marta'
      ],
      'Artemisa': [
        'Alquízar',
        'Artemisa',
        'Bauta',
        'Caimito',
        'Candelaria',
        'Guanajay',
        'Güira de Melena',
        'Mariel',
        'San Antonio de los Baños',
        'San Cristóbal'
      ],
      'Mayabeque': [
        'Batabanó',
        'Bejucal',
        'Güines',
        'Jaruco',
        'Madruga',
        'Melena del Sur',
        'Nueva Paz',
        'Quivicán',
        'San José de las Lajas',
        'San Nicolás'
      ],
      'Isla de la Juventud': [
        'Isla de la Juventud'
      ],
      'Villa Clara': [
        'Camajuaní',
        'Caibarién',
        'Cifuentes',
        'Corralillo',
        'Encrucijada',
        'Manicaragua',
        'Placetas',
        'Quemado de Güines',
        'Ranchuelo',
        'Remedios',
        'Santa Clara',
        'Sagua la Grande',
        'Santo Domingo'
      ],
      'Cienfuegos': [
        'Aguada de Pasajeros',
        'Cienfuegos',
        'Cumanayagua',
        'Cruces',
        'Lajas',
        'Palmira',
        'Rodas',
        'Abreus'
      ],
      'Sancti Spíritus': [
        'Cabaiguán',
        'Fomento',
        'Jatibonico',
        'La Sierpe',
        'Sancti Spíritus',
        'Taguasco',
        'Trinidad',
        'Yaguajay'
      ],
      'Ciego de Ávila': [
        'Baraguá',
        'Bolivia',
        'Chambas',
        'Ciego de Ávila',
        'Ciro Redondo',
        'Florencia',
        'Majagua',
        'Morón',
        'Primero de Enero',
        'Venezuela'
      ],
      'Camagüey': [
        'Camagüey',
        'Carlos Manuel de Céspedes',
        'Esmeralda',
        'Florida',
        'Guaimaro',
        'Jimaguayú',
        'Minas',
        'Najasa',
        'Nuevitas',
        'Santa Cruz del Sur',
        'Sibanicú',
        'Vertientes'
      ],
      'Las Tunas': [
        'Amancio',
        'Colombia',
        'Jesús Menéndez',
        'Jobabo',
        'Las Tunas',
        'Majibacoa',
        'Manatí',
        'Puerto Padre'
      ],
      'Holguín': [
        'Antilla',
        'Báguanos',
        'Banes',
        'Cacocum',
        'Calixto García',
        'Cueto',
        'Frank País',
        'Gibara',
        'Holguín',
        'Mayarí',
        'Moa',
        'Rafael Freyre',
        'Sagua de Tánamo',
        'Urbano Noris'
      ],
      'Granma': [
        'Bartolomé Masó',
        'Bayamo',
        'Buey Arriba',
        'Campechuela',
        'Cauto Cristo',
        'Guisa',
        'Jiguaní',
        'Manzanillo',
        'Media Luna',
        'Niquero',
        'Pilón',
        'Río Cauto',
        'Yara'
      ],
      'Guantánamo': [
        'Baracoa',
        'Caimanera',
        'El Salvador',
        'Guantánamo',
        'Imías',
        'Maisí',
        'Manuel Tames',
        'Niceto Pérez',
        'San Antonio del Sur',
        'Yateras'
      ]
    };


    // Verificar y asignar el evento al botón "aggrent"
    const aggrentButton = document.getElementById('aggrent');
    if (aggrentButton) {
      aggrentButton.addEventListener('click', function() {
        console.log('Botón "Agregar Renta" clickeado');

        // Restablecer el formulario
        document.getElementById('addRentalForm').reset();
        document.getElementById('addRentalForm').action = 'php-add-rent.php';
        document.getElementById('addRentalModalLabel').textContent = 'Agregar Renta';

        // Restablecer el select de municipio
        const municipioSelect = document.getElementById('municipio1');
        if (municipioSelect) {
          municipioSelect.innerHTML = '<option value="" selected>Municipio</option>';
          municipioSelect.disabled = true;
        } else {
          console.error('El select de "municipio1" no fue encontrado en el DOM.');
        }

        // Limpiar los checkboxes de servicios
        const servicesCheckboxes = document.getElementById('servicesCheckboxes');
        if (servicesCheckboxes) {
          servicesCheckboxes.innerHTML = '';
        } else {
          console.error('El contenedor de servicios no fue encontrado en el DOM.');
        }

        // Limpiar los campos de habitaciones y capacidad
        document.getElementById('habitaciones').value = '';
        document.getElementById('capacidad').value = '';

        // Cargar servicios cuando se agrega una nueva renta
        cargarServicios([]);

        // Mostrar los contenedores que se ocultaron al editar
        const containers = document.querySelectorAll(' .images-content');
        containers.forEach(container => {
          container.classList.remove('d-none');
          console.log('Contenedor mostrado:', container); // Depuración
        });
      });
    } else {
      console.error('El botón "aggrent" no fue encontrado en el DOM.');
    }

    // Lógica para editar rentas
    const editButtons = document.querySelectorAll('.edit-rental-btn');
    console.log(`Número de botones de edición encontrados: ${editButtons.length}`);

    editButtons.forEach(button => {
      button.addEventListener('click', function() {
        console.log('Botón de editar clickeado');
        const rentalId = this.getAttribute('data-rental-id');
        console.log(`ID de renta a editar: ${rentalId}`);

        fetch(`php-get-rent.php?id=${rentalId}`)
          .then(response => {
            if (!response.ok) {
              throw new Error('Error en la solicitud: ' + response.statusText);
            }
            return response.json();
          })
          .then(data => {
            if (data.error) {
              console.error(data.error);
              return;
            }

            console.log('Datos recibidos:', data);

            // Llenar los campos del formulario con los datos obtenidos
            document.getElementById('rentalTitle').value = data.rentalTitle;
            document.getElementById('rentalDescription').value = data.rentalDescription;
            document.getElementById('rentalPrice').value = data.rentalPrice;
            document.getElementById('rentalPriceType').value = data.rentalPriceType;
            document.getElementById('typeTimeRent').value = data.typeTimeRent;
            document.getElementById('rentalLocation').value = data.rentalLocation;
            document.getElementById('rentalCategory').value = data.category;
            document.getElementById('provincia1').value = data.provincia;
            document.getElementById('habitaciones').value = data.habitaciones;
            document.getElementById('capacidad').value = data.capacidad;

            // Cargar y seleccionar el municipio
            cargarMunicipios(data.provincia, data.municipio);

            // Cargar y seleccionar los servicios
            cargarServicios(data.selectedServices);

            // Cambiar la acción del formulario para editar
            document.getElementById('addRentalForm').action = `php-edit-rent.php?id=${rentalId}`;
            document.getElementById('addRentalModalLabel').textContent = 'Editar Renta';

            // Ocultar los contenedores
            const containers = document.querySelectorAll('.services-content, .images-content');
            containers.forEach(container => {
              container.classList.add('d-none');
              console.log('Contenedor ocultado:', container); // Depuración
            });
          })
          .catch(error => console.error('Error:', error));
      });
    });

    // Restaurar el formulario al estado de agregar cuando se cierra el modal
    $('#addRentalModal').on('hidden.bs.modal', function() {
      document.getElementById('addRentalForm').reset();
      document.getElementById('addRentalForm').action = 'php-add-rent.php';
      document.getElementById('addRentalModalLabel').textContent = 'Agregar Renta';

      // Restablecer el select de municipio
      const municipioSelect = document.getElementById('municipio1');
      if (municipioSelect) {
        municipioSelect.innerHTML = '<option value="" selected>Municipio</option>';
        municipioSelect.disabled = true;
      } else {
        console.error('El select de "municipio1" no fue encontrado en el DOM.');
      }

      // Limpiar los checkboxes de servicios
      const servicesCheckboxes = document.getElementById('servicesCheckboxes');
      if (servicesCheckboxes) {
        servicesCheckboxes.innerHTML = '';
      } else {
        console.error('El contenedor de servicios no fue encontrado en el DOM.');
      }

      // Limpiar los campos de habitaciones y capacidad
      document.getElementById('habitaciones').value = '';
      document.getElementById('capacidad').value = '';

      // Cargar servicios cuando se agrega una nueva renta
      cargarServicios([]);

      // Mostrar los contenedores nuevamente
      const containers = document.querySelectorAll('.services-content, .images-content, .ubi-content');
      containers.forEach(container => {
        container.classList.remove('d-none');
        console.log('Contenedor mostrado:', container); // Depuración
      });
    });

    // Asignar evento de cambio al seleccionar la provincia
    const provinciaSelect = document.getElementById('provincia1');
    if (provinciaSelect) {
      provinciaSelect.addEventListener('change', function() {
        const provincia = this.value;
        cargarMunicipios(provincia);
      });
    } else {
      console.error('El select de "provincia1" no fue encontrado en el DOM.');
    }

    // Función para cargar y seleccionar los municipios
    function cargarMunicipios(provincia, selectedMunicipio = '') {
      const municipioSelect = document.getElementById('municipio1');
      if (municipioSelect) {
        municipioSelect.innerHTML = '<option value="" selected>Municipio</option>';
        municipioSelect.disabled = false;

        if (provincia && provinciasMunicipios[provincia]) {
          provinciasMunicipios[provincia].forEach(municipio => {
            const option = document.createElement('option');
            option.value = municipio;
            option.text = municipio;
            if (municipio === selectedMunicipio) {
              option.selected = true;
            }
            municipioSelect.appendChild(option);
          });
        }
      } else {
        console.error('El select de "municipio1" no fue encontrado en el DOM.');
      }
    }

    // Función para cargar y seleccionar los servicios
    function cargarServicios(selectedServices) {
      fetch('php-get-services.php')
        .then(response => {
          if (!response.ok) {
            throw new Error('Error en la solicitud: ' + response.statusText);
          }
          return response.json();
        })
        .then(services => {
          const servicesContainer = document.getElementById('servicesCheckboxes');
          if (servicesContainer) {
            servicesContainer.innerHTML = '';
            services.forEach(service => {
              const isChecked = Array.isArray(selectedServices) && selectedServices.includes(service.id.toString()) ? 'checked' : '';
              const checkbox = `
                            <div class="col-6 checkbox-wrapper-16">
                                <label class="checkbox-wrapper">
                                    <input class="checkbox-input" type="checkbox" value="${service.id}" id="service_${service.id}" name="services[]" ${isChecked}>
                                    <span class="checkbox-tile">
                                        <span class="checkbox-icon">${service.icon}</span>
                                        <span class="small">${service.name}</span>
                                    </span>
                                </label>
                            </div>`;
              servicesContainer.innerHTML += checkbox;
            });
          } else {
            console.error('El contenedor de servicios no fue encontrado en el DOM.');
          }
        })
        .catch(error => console.error('Error:', error));
    }
  });
</script>


<!-- Bootstrap JS, Popper.js, and jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    // Script para aplicar gradientes aleatorios
    (function() {
      // Función para generar un color hexadecimal aleatorio
      function getRandomColor() {
        return '#' + Math.floor(Math.random() * 16777215).toString(16);
      }

      // Función para aplicar un gradiente aleatorio a un elemento
      function applyRandomGradient(element) {
        const color1 = getRandomColor();
        const color2 = getRandomColor();
        element.style.backgroundImage = `linear-gradient(45deg, ${color1}, ${color2})`;
      }

      // Obtener todos los elementos con la clase 'bg-gradient-al'
      const elements = document.querySelectorAll('.bg-gradient-al');

      // Aplicar gradiente aleatorio a cada elemento
      elements.forEach(element => applyRandomGradient(element));
    })();
  });
</script>

<style>
  /* From Uiverse.io by Bodyhc */
  .checkbox-wrapper-16 *,
  .checkbox-wrapper-16 *:after,
  .checkbox-wrapper-16 *:before {
    box-sizing: border-box;
  }

  .checkbox-wrapper-16 .checkbox-input {
    clip: rect(0 0 0 0);
    -webkit-clip-path: inset(100%);
    clip-path: inset(100%);
    height: 1px;
    overflow: hidden;
    position: absolute;
    white-space: nowrap;
    width: 1px;
  }

  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile {
    border-color: #2193b0;
    display: flex !important;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
    background-color: #2193b0;
    border-color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-icon,
  .checkbox-wrapper-16 .checkbox-input:checked+.checkbox-tile .checkbox-label {
    color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile {
    border-color: #2193b0;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1), 0 0 0 4pxrgb(123, 229, 255);
  }

  .checkbox-wrapper-16 .checkbox-input:focus+.checkbox-tile:before {
    transform: scale(1);
    opacity: 1;
  }

  .checkbox-wrapper-16 .checkbox-tile {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 30px !important;
    width: 200px;
    height: 40px;
    border-radius: 0.5rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
    transition: 0.15s ease;
    cursor: pointer;
    position: relative;
  }

  .checkbox-wrapper-16 .checkbox-tile:before {
    content: "";
    position: absolute;
    display: flex;
    width: 1.25rem;
    height: 1.25rem;
    border: 2px solid #b5bfd9;
    background-color: #fff;
    border-radius: 50%;
    top: 0.25rem;
    left: 0.25rem;
    opacity: 0;
    transform: scale(0);
    transition: 0.25s ease;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='192' height='192' fill='%23FFFFFF' viewBox='0 0 256 256'%3E%3Crect width='256' height='256' fill='none'%3E%3C/rect%3E%3Cpolyline points='216 72.005 104 184 48 128.005' fill='none' stroke='%23FFFFFF' stroke-linecap='round' stroke-linejoin='round' stroke-width='32'%3E%3C/polyline%3E%3C/svg%3E");
    background-size: 12px;
    background-repeat: no-repeat;
    background-position: 50% 50%;
  }

  .checkbox-wrapper-16 .checkbox-tile:hover {
    border-color: #2193b0;
  }

  .checkbox-wrapper-16 .checkbox-tile:hover:before {
    transform: scale(1);
    opacity: 1;
  }

  .checkbox-wrapper-16 .checkbox-icon {
    margin-bottom: -3px !important;
    margin-right: 0px !important;
    transition: 0.375s ease;
    color: #494949;
    margin-right: 3px;
    /* Añadir espacio entre el ícono y el texto */
  }

  .checkbox-wrapper-16 .checkbox-label {
    color: #707070;
    transition: 0.375s ease;
    text-align: left;
    /* Ajustar alineación del texto */
  }
</style>