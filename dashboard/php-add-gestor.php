<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $telefono = $_POST['telefono'];

    $sql = "INSERT INTO Gestores (nombre, telefono) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('ss', $nombre, $telefono);

    if ($stmt->execute()) {
        echo "Gestor agregado exitosamente.";
    } else {
        echo "Error al agregar el gestor: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirigir de nuevo a la página de administración de gestores
    header("Location: reservas.php?status=success");
    exit();
}
?>