<?php
include '../uixsoftware/config/config.php';

header('Content-Type: application/json');

$sql = "SELECT services_rent_id AS id, services_rent_name AS name, services_rent_icon_svg AS icon FROM services_rent";
$result = $conn->query($sql);

$services = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $services[] = $row;
    }
}

$conn->close();

echo json_encode($services);
?>
