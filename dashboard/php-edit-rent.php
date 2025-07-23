<?php
include '../uixsoftware/config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $rentalId = intval($_GET['id']);

    // Obtener los datos del formulario
    $rentalTitle = $_POST['rentalTitle'];
    $rentalCategory = $_POST['rentalCategory']; // Nuevo campo
    $rentalDescription = $_POST['rentalDescription'];
    $rentalPrice = $_POST['rentalPrice'];
    $rentalPriceType = $_POST['rentalPriceType'];
    $typeTimeRent = $_POST['typeTimeRent'];
    $rentalLocation = $_POST['rentalLocation'];
    $rentalRooms = $_POST['habitaciones'];
    $rentalCapacity = $_POST['capacidad'];

    // Actualizar los datos de la renta
    $stmt = $conn->prepare("UPDATE Rentals SET rental_title = ?, rental_category = ?, rental_description = ?, rental_price = ?, rental_price_type = ?, type_time_rent = ?, rental_location = ?, rental_rooms = ?, rental_capacity = ? WHERE rental_id = ?");
    $stmt->bind_param("sssssssiii", $rentalTitle, $rentalCategory, $rentalDescription, $rentalPrice, $rentalPriceType, $typeTimeRent, $rentalLocation, $rentalRooms, $rentalCapacity, $rentalId);

    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();

        // Redirigir con mensaje de éxito
        header("Location: rents.php?status=success");
        exit();
    } else {
        $stmt->close();
        $conn->close();

        // Redirigir con mensaje de error
        header("Location: rents.php?status=error");
        exit();
    }
}