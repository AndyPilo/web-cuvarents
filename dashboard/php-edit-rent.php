<?php
include '../uixsoftware/config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $rentalId = intval($_GET['id']);

    // Obtener los datos del formulario
    $rentalTitle = $_POST['rentalTitle'];
    $rentalCategory = $_POST['rentalCategory'];
    $rentalDescription = $_POST['rentalDescription'];
    $rentalPrice = $_POST['rentalPrice'];
    $rentalPriceType = $_POST['rentalPriceType'];
    $typeTimeRent = $_POST['typeTimeRent'];
    $rentalLocation = $_POST['rentalLocation'];
    $rentalRooms = $_POST['habitaciones'];
    $rentalCapacity = $_POST['capacidad'];

    // Obtener provincia y municipio
    $provincia = $_POST['provincia1'];
    $municipio = $_POST['municipio1'];

    // Actualizar los datos en la base de datos, incluyendo provincia y municipio
    $stmt = $conn->prepare("
        UPDATE Rentals 
        SET 
            rental_title = ?, 
            rental_category = ?, 
            rental_description = ?, 
            rental_price = ?, 
            rental_price_type = ?, 
            type_time_rent = ?, 
            rental_location = ?, 
            rental_rooms = ?, 
            rental_capacity = ?, 
            rental_provincia = ?, 
            rental_municipio = ?
        WHERE rental_id = ?
    ");

    // Vincular parámetros
    $stmt->bind_param(
        "sssssssisssi",
        $rentalTitle,
        $rentalCategory,
        $rentalDescription,
        $rentalPrice,
        $rentalPriceType,
        $typeTimeRent,
        $rentalLocation,
        $rentalRooms,
        $rentalCapacity,
        $provincia,
        $municipio,
        $rentalId
    );

    // Ejecutar y redirigir
    if ($stmt->execute()) {
        $stmt->close();
        $conn->close();
        header("Location: rents.php?status=success");
        exit();
    } else {
        $stmt->close();
        $conn->close();
        header("Location: rents.php?status=error");
        exit();
    }
}
