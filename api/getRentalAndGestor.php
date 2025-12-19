<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../src/models/Renta.php';
require_once __DIR__ . '/../src/models/Gestor.php';

try {
    $rentalId = isset($_GET['rental_id']) ? (int)$_GET['rental_id'] : 0;

    if ($rentalId <= 0) {
        http_response_code(400);
        echo json_encode(['error' => 'ID de renta inválido.']);
        exit;
    }

    $rentaModel = new Renta();
    $gestorModel = new Gestor();

    $renta = $rentaModel->getById($rentalId);
    $gestor = $gestorModel->getActivo();

    if (!$renta) {
        http_response_code(404);
        echo json_encode(['error' => 'Renta no encontrada.']);
        exit;
    }

    echo json_encode([
        'rental' => $renta,
        'telefono' => $gestor['telefono'] ?? null
    ], JSON_UNESCAPED_UNICODE);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error interno del servidor',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
