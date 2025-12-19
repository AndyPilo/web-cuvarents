<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../src/models/Service.php';

header('Content-Type: application/json; charset=UTF-8');

try {
    $serviceModel = new Service();
    $services = $serviceModel->getAllServices();

    echo json_encode($services, JSON_UNESCAPED_UNICODE);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al obtener los servicios',
        'details' => $e->getMessage()
    ]);
}
