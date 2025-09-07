<?php
include '../uixsoftware/config/config.php';
header('Content-Type: application/json');

$response = [];

if (isset($_GET['id'])) {
    $rentalId = intval($_GET['id']);

    // Obtener datos de la renta
    $sql = "SELECT * FROM Rentals WHERE rental_id = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param('i', $rentalId);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $rental = $result->fetch_assoc();

            // Obtener los servicios seleccionados
            $sqlServices = "SELECT service_rent_id FROM RentalServices WHERE rental_id = ?";
            $stmtServices = $conn->prepare($sqlServices);
            $stmtServices->bind_param('i', $rentalId);
            $stmtServices->execute();
            $resultServices = $stmtServices->get_result();
            $selectedServices = [];
            while ($row = $resultServices->fetch_assoc()) {
                $selectedServices[] = $row['service_rent_id'];
            }
            $stmtServices->close();

            // 🔥 Obtener imágenes asociadas
            $sqlImages = "SELECT image_id, image_url FROM RentalImages WHERE rental_id = ?";
            $stmtImages = $conn->prepare($sqlImages);
            $stmtImages->bind_param('i', $rentalId);
            $stmtImages->execute();
            $resultImages = $stmtImages->get_result();
            $images = [];
            while ($rowImg = $resultImages->fetch_assoc()) {
                $images[] = [
                    'id' => $rowImg['image_id'],
                    'url' => $rowImg['image_url']
                ];
            }
            $stmtImages->close();

            // Construir respuesta
            $response = [
                'rentalTitle'       => htmlspecialchars($rental['rental_title'], ENT_QUOTES, 'UTF-8'),
                'rentalDescription' => htmlspecialchars($rental['rental_description'], ENT_QUOTES, 'UTF-8'),
                'rentalPrice'       => htmlspecialchars($rental['rental_price'], ENT_QUOTES, 'UTF-8'),
                'rentalPriceType'   => htmlspecialchars($rental['rental_price_type'], ENT_QUOTES, 'UTF-8'),
                'typeTimeRent'      => htmlspecialchars($rental['type_time_rent'], ENT_QUOTES, 'UTF-8'),
                'rentalLocation'    => htmlspecialchars($rental['rental_location'], ENT_QUOTES, 'UTF-8'),
                'category'          => htmlspecialchars($rental['rental_category'], ENT_QUOTES, 'UTF-8'),
                'provincia'         => htmlspecialchars($rental['rental_provincia'], ENT_QUOTES, 'UTF-8'),
                'municipio'         => htmlspecialchars($rental['rental_municipio'], ENT_QUOTES, 'UTF-8'),
                'habitaciones'      => intval($rental['rental_rooms']),
                'capacidad'         => intval($rental['rental_capacity']),
                'selectedServices'  => $selectedServices,
                'images'            => $images // 🔥 ya tienes las imágenes
            ];
        } else {
            $response = ['error' => 'Renta no encontrada'];
        }
        $stmt->close();
    } else {
        $response = ['error' => 'Error en la consulta a la base de datos: ' . $conn->error];
    }
} else {
    $response = ['error' => 'ID de renta no proporcionado'];
}

$conn->close();
echo json_encode($response);
