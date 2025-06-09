<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $serviceName = htmlspecialchars($_POST['serviceName'], ENT_QUOTES, 'UTF-8');
    $serviceIcon = $_POST['serviceIcon']; // Assuming serviceIcon is safe as it comes from a fixed set

    $sql = "INSERT INTO services_rent (services_rent_name, services_rent_icon_svg) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $serviceName, $serviceIcon);

    if ($stmt->execute()) {
        echo "Servicio agregado exitosamente.";
    } else {
        echo "Error al agregar el servicio: " . $conn->error;
    }

    $stmt->close();

    header("Location: comodities.php"); // Redirige a la página de administración
    exit();
}
?>