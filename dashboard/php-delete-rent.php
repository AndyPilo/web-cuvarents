<?php
// Mostrar todos los errores de PHP (Desactivar en producción)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rental_id'])) {
    $rentalId = intval($_POST['rental_id']);

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Eliminar imágenes asociadas
        $sql = "DELETE FROM RentalImages WHERE rental_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $stmt->close();

        // Eliminar servicios asociados
        $sql = "DELETE FROM RentalServices WHERE rental_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $stmt->close();

        // Eliminar la renta
        $sql = "DELETE FROM Rentals WHERE rental_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $stmt->close();

        // Confirmar transacción
        $conn->commit();

        header("Location: rents.php?status=success");
        exit();
    } catch (Exception $e) {
        // Revertir transacción
        $conn->rollback();

        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de renta no proporcionado o método no permitido']);
}
?>
