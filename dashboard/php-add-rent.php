<?php
include '../uixsoftware/config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $rentalTitle = $_POST['rentalTitle'];
    $rentalCategory = $_POST['rentalCategory']; // Nuevo campo
    $rentalDescription = $_POST['rentalDescription'];
    $rentalPrice = $_POST['rentalPrice'];
    $rentalPriceType = $_POST['rentalPriceType'];
    $typeTimeRent = $_POST['typeTimeRent'];
    $provincia = $_POST['provincia1'];
    $municipio = $_POST['municipio1'];
    $rentalRooms = $_POST['habitaciones'];
    $rentalCapacity = $_POST['capacidad'];
    $services = isset($_POST['services']) ? $_POST['services'] : [];

    // Comprobar que los campos provincia y municipio no estén vacíos
    if (empty($provincia) || empty($municipio)) {
        header("Location: rents.php?status=error&message=Faltan datos de la provincia o municipio");
        exit();
    }

    // Insertar los datos de la renta
    $stmt2 = $conn->prepare("INSERT INTO Rentals (rental_title, rental_category, rental_description, rental_price, rental_price_type, type_time_rent, rental_location, rental_provincia, rental_municipio, rental_rooms, rental_capacity) VALUES (?, ?, ?, ?, ?, ?, 'Oculto', ?, ?, ?, ?)");
    $stmt2->bind_param("ssssssssii", $rentalTitle, $rentalCategory, $rentalDescription, $rentalPrice, $rentalPriceType, $typeTimeRent, $provincia, $municipio, $rentalRooms, $rentalCapacity);

    if ($stmt2->execute()) {
        $rentalId = $stmt2->insert_id;

        // Verificar si la carpeta de destino existe, sino crearla
        $uploadDir = 'uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Guardar las imágenes
        foreach ($_FILES['rentalImages']['tmp_name'] as $key => $tmpName) {
            $fileExt = pathinfo($_FILES['rentalImages']['name'][$key], PATHINFO_EXTENSION);
            $uniqueFileName = uniqid() . '.' . $fileExt;
            $targetFilePath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($tmpName, $targetFilePath)) {
                $stmtImg = $conn->prepare("INSERT INTO RentalImages (rental_id, image_url) VALUES (?, ?)");
                $stmtImg->bind_param("is", $rentalId, $uniqueFileName);
                $stmtImg->execute();
            }
        }

        // Guardar los servicios seleccionados
        foreach ($services as $serviceId) {
            $stmtSrv = $conn->prepare("INSERT INTO RentalServices (rental_id, service_rent_id) VALUES (?, ?)");
            $stmtSrv->bind_param("ii", $rentalId, $serviceId);
            $stmtSrv->execute();
        }

        $stmt2->close();
        $conn->close();

        // Redirigir con mensaje de éxito
        header("Location: rents.php?status=success");
        exit();
    } else {
        $stmt2->close();
        $conn->close();

        // Redirigir con mensaje de error
        header("Location: rents.php?status=error");
        exit();
    }
}
?>