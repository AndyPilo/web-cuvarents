<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['service_id'])) {
    $serviceId = intval($_POST['service_id']);

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // Eliminar referencias en la tabla RentalServices
        $sql = "DELETE FROM RentalServices WHERE service_rent_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $serviceId);
        $stmt->execute();
        $stmt->close();

        // Eliminar el servicio de la tabla services_rent
        $sql = "DELETE FROM services_rent WHERE services_rent_id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param('i', $serviceId);
        $stmt->execute();
        $stmt->close();

        // Confirmar transacción
        $conn->commit();

        // Redirigir con mensaje de éxito
        header("Location: comodities.php?status=success");
        exit();
    } catch (Exception $e) {
        // Revertir transacción
        $conn->rollback();

        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

} else {
    echo json_encode(['status' => 'error', 'message' => 'ID del servicio no proporcionado o método no permitido']);
}
?>