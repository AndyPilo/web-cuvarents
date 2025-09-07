<?php
include '../uixsoftware/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['rental_id'])) {
    $rentalId = intval($_POST['rental_id']);

    // Iniciar transacción
    $conn->begin_transaction();

    try {
        // 1️⃣ Obtener todas las imágenes del rental
        $stmtImg = $conn->prepare("SELECT image_url FROM RentalImages WHERE rental_id = ?");
        $stmtImg->bind_param("i", $rentalId);
        $stmtImg->execute();
        $resultImg = $stmtImg->get_result();
        $images = [];
        while ($row = $resultImg->fetch_assoc()) {
            $images[] = $row['image_url'];
        }
        $stmtImg->close();

        // 2️⃣ Eliminar archivos físicos
        foreach ($images as $img) {
            $filePath = 'uploads/' . $img;
            if (file_exists($filePath)) unlink($filePath);
        }

        // 3️⃣ Eliminar imágenes de la base de datos
        $stmt = $conn->prepare("DELETE FROM RentalImages WHERE rental_id = ?");
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $stmt->close();

        // 4️⃣ Eliminar servicios asociados
        $stmt = $conn->prepare("DELETE FROM RentalServices WHERE rental_id = ?");
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $stmt->close();

        // 5️⃣ Eliminar la renta
        $stmt = $conn->prepare("DELETE FROM Rentals WHERE rental_id = ?");
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $stmt->close();

        // Confirmar transacción
        $conn->commit();

        header("Location: rents.php?status=success");
        exit();
    } catch (Exception $e) {
        $conn->rollback();
        echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'ID de renta no proporcionado o método no permitido']);
}
