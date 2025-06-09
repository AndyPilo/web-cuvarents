<?php
// Detectar si estamos en entorno local (localhost) o producción (Hostinger)
if ($_SERVER['SERVER_NAME'] === 'localhost') {
    // Configuración local (XAMPP)
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "u756511143_cuvarents"; // Cambia esto por el nombre real de tu base local
} else {
    // Configuración del servidor (Hostinger)
    $servername = "localhost"; // usualmente localhost en Hostinger también
    $username = "u756511143_cuvarents";
    $password = "*B1k:=NE";
    $dbname = "u756511143_cuvarents";
}

// Habilitar el registro de errores (opcional para debug)
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/error.log');
error_reporting(E_ALL);

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
