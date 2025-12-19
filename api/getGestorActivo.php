<?php
header('Content-Type: application/json; charset=utf-8');

require_once __DIR__ . '/../src/models/Gestor.php';

try {
    $gestorModel = new Gestor();
    $gestor = $gestorModel->getActivo();

    if ($gestor) {
        echo json_encode(['telefono' => $gestor['telefono']], JSON_UNESCAPED_UNICODE);
    } else {
        http_response_code(404);
        echo json_encode(['error' => 'No hay gestores activos.']);
    }
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error interno del servidor',
        'details' => $e->getMessage()
    ], JSON_UNESCAPED_UNICODE);
}
