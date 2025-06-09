<?php
include 'uixsoftware/config/config.php';

$rentalId = isset($_GET['rental_id']) ? (int)$_GET['rental_id'] : 0;

$response = [];

if ($rentalId > 0) {
    // Obtener los detalles de la renta
    $sqlRental = "SELECT Rentals.*, GROUP_CONCAT(RentalImages.image_url) AS images FROM Rentals
                  LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                  WHERE Rentals.rental_id = $rentalId
                  GROUP BY Rentals.rental_id";
    $resultRental = $conn->query($sqlRental);

    if ($resultRental->num_rows > 0) {
        $response['rental'] = $resultRental->fetch_assoc();
    }

    // Obtener el número de teléfono del gestor activo
    $sqlGestor = "SELECT telefono FROM Gestores WHERE activo = TRUE LIMIT 1";
    $resultGestor = $conn->query($sqlGestor);

    if ($resultGestor->num_rows > 0) {
        $response['telefono'] = $resultGestor->fetch_assoc()['telefono'];
    }
}

$conn->close();

header('Content-Type: application/json');
echo json_encode($response);
?>
