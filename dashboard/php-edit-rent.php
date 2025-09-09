<?php
include '../uixsoftware/config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_GET['id'])) {
    $rentalId = intval($_GET['id']);

    // Obtener los datos del formulario
    $rentalTitle       = $_POST['rentalTitle'];
    $rentalCategory    = $_POST['rentalCategory'];
    $rentalDescription = $_POST['rentalDescription'];
    $rentalPrice       = $_POST['rentalPrice'];
    $rentalPriceType   = $_POST['rentalPriceType'];
    $typeTimeRent      = $_POST['typeTimeRent'];
    $provincia         = $_POST['provincia1'];
    $municipio         = $_POST['municipio1'];
    $rentalRooms       = $_POST['habitaciones'];
    $rentalCapacity    = $_POST['capacidad'];
    $services          = isset($_POST['services']) ? $_POST['services'] : [];

    // ✅ 1. Actualizar los datos principales de la renta
    $stmt = $conn->prepare("
        UPDATE Rentals 
        SET 
            rental_title = ?, 
            rental_category = ?, 
            rental_description = ?, 
            rental_price = ?, 
            rental_price_type = ?, 
            type_time_rent = ?, 
            rental_provincia = ?, 
            rental_municipio = ?, 
            rental_rooms = ?, 
            rental_capacity = ?
        WHERE rental_id = ?
    ");
    $stmt->bind_param(
        "ssssssssiii",
        $rentalTitle,
        $rentalCategory,
        $rentalDescription,
        $rentalPrice,
        $rentalPriceType,
        $typeTimeRent,
        $provincia,
        $municipio,
        $rentalRooms,
        $rentalCapacity,
        $rentalId
    );
    $stmt->execute();
    $stmt->close();

    // ✅ 2. Eliminar imágenes marcadas
    if (!empty($_POST['imagesToDelete'])) {
        foreach ($_POST['imagesToDelete'] as $imageId) {
            $imageId = intval($imageId);

            $stmtImg = $conn->prepare("SELECT image_url FROM RentalImages WHERE image_id = ? AND rental_id = ?");
            $stmtImg->bind_param("ii", $imageId, $rentalId);
            $stmtImg->execute();
            $resultImg = $stmtImg->get_result()->fetch_assoc();
            $stmtImg->close();

            if ($resultImg) {
                $filePath = 'uploads/' . $resultImg['image_url'];
                if (file_exists($filePath)) unlink($filePath);

                $stmtDel = $conn->prepare("DELETE FROM RentalImages WHERE image_id = ? AND rental_id = ?");
                $stmtDel->bind_param("ii", $imageId, $rentalId);
                $stmtDel->execute();
                $stmtDel->close();
            }
        }
    }

    // ✅ 3. Subir nuevas imágenes
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0755, true);
    }
    $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];

    function resizeImage($sourcePath, $destinationPath, $maxWidth = 1200, $quality = 85)
    {
        $info = getimagesize($sourcePath);
        if ($info === false) return false;

        list($origWidth, $origHeight) = $info;
        $mime = $info['mime'];

        if ($origWidth > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = intval(($origHeight / $origWidth) * $newWidth);
        } else {
            return move_uploaded_file($sourcePath, $destinationPath);
        }

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        $resized = imagecreatetruecolor($newWidth, $newHeight);

        if ($mime === 'image/png') {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
        }

        imagecopyresampled($resized, $image, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);

        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resized, $destinationPath, $quality);
                break;
            case 'image/png':
                imagepng($resized, $destinationPath, 8);
                break;
            case 'image/webp':
                imagewebp($resized, $destinationPath, $quality);
                break;
        }

        imagedestroy($image);
        imagedestroy($resized);
        return true;
    }

    if (!empty($_FILES['rentalImages']['tmp_name'][0])) {
        foreach ($_FILES['rentalImages']['tmp_name'] as $key => $tmpName) {
            $originalName = $_FILES['rentalImages']['name'][$key];
            $fileExt = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            if (!in_array($fileExt, $allowedExts)) continue;
            if (!getimagesize($tmpName)) continue;

            $baseName = strtolower(preg_replace('/[^\p{L}0-9]+/u', '-', $rentalTitle));
            $uniqueFileName = $baseName . '-' . uniqid() . '.' . $fileExt;
            $targetFilePath = $uploadDir . $uniqueFileName;

            if (resizeImage($tmpName, $targetFilePath)) {
                $stmtImg = $conn->prepare("INSERT INTO RentalImages (rental_id, image_url) VALUES (?, ?)");
                $stmtImg->bind_param("is", $rentalId, $uniqueFileName);
                $stmtImg->execute();
                $stmtImg->close();
            }
        }
    }

    // ✅ 4. Actualizar servicios
    $stmtSrvDel = $conn->prepare("DELETE FROM RentalServices WHERE rental_id = ?");
    $stmtSrvDel->bind_param("i", $rentalId);
    $stmtSrvDel->execute();
    $stmtSrvDel->close();

    foreach ($services as $serviceId) {
        $stmtSrv = $conn->prepare("INSERT INTO RentalServices (rental_id, service_rent_id) VALUES (?, ?)");
        $stmtSrv->bind_param("ii", $rentalId, $serviceId);
        $stmtSrv->execute();
        $stmtSrv->close();
    }

    $conn->close();

    // ✅ Redirigir con éxito
    header("Location: rents.php?status=success");
    exit();
}
