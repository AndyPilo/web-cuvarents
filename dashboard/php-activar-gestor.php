<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Desactivar todos los gestores actuales
    $conn->query("UPDATE Gestores SET activo = FALSE");

    // Activar el gestor seleccionado
    $sql = "UPDATE Gestores SET activo = TRUE WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $id);

    if ($stmt->execute()) {
        echo "Gestor activado exitosamente.";
    } else {
        echo "Error al activar el gestor: " . $conn->error;
    }

    $stmt->close();
    $conn->close();

    // Redirigir de nuevo a la página de administración de gestores
    header("Location: reservas.php?status=success");
    exit();
}
?>