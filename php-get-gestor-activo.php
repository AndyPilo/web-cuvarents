<?php
include 'uixsoftware/config/config.php';

header('Content-Type: application/json');

$sql = "SELECT telefono FROM Gestores WHERE activo = TRUE LIMIT 1";
$result = $conn->query($sql);

$response = [];

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['telefono'] = $row['telefono'];
} else {
    $response['error'] = 'No hay gestores activos.';
}

$conn->close();

echo json_encode($response);
?>
