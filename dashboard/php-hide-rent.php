<?php
// Mostrar todos los errores de PHP (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rental_id'])) {
    $rentalId = intval($_POST['rental_id']);
    $sql = "UPDATE Rentals SET is_hidden = TRUE, is_promoted = FALSE WHERE rental_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $rentalId);
        if ($stmt->execute()) {
            // Redirigir con mensaje de éxito
            header("Location: rents.php?status=success");
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo ocultar la renta']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de renta no proporcionado o método no permitido']);
}
