<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rental_id'])) {
    $rentalId = intval($_POST['rental_id']);
    $sql = "UPDATE Rentals SET is_promoted = FALSE WHERE rental_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $rentalId);
        if ($stmt->execute()) {
            header("Location: rents.php?status=success");
            exit();
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No se pudo quitar la promoción de la renta']);
        }
        $stmt->close();
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta']);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de renta no proporcionado o método no permitido']);
}
?>