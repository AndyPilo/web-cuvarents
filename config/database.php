<?php

/**
 * Clase Database
 * Maneja la conexión a la base de datos con PDO mediante Singleton.
 */

class Database
{
    private static $instance = null;

    public static function connect(): PDO
    {
        if (self::$instance === null) {
            $isLocal = ($_SERVER['SERVER_NAME'] === 'localhost');

            if ($isLocal) {
                $dbHost = 'localhost';
                $dbName = 'u756511143_cuvarents';
                $dbUser = 'root';
                $dbPass = '';
            } else {
                $dbHost = 'localhost';
                $dbName = 'u756511143_cuvarents';
                $dbUser = 'u756511143_cuvarents';
                $dbPass = '*B1k:=NE';
            }

            $dsn = "mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4";

            try {
                self::$instance = new PDO($dsn, $dbUser, $dbPass, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    PDO::ATTR_PERSISTENT         => false,
                    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
                ]);
            } catch (PDOException $e) {
                error_log("❌ Error de conexión PDO: " . $e->getMessage());
                die("Error de conexión a la base de datos. Por favor, contacta al administrador.");
            }
        }

        return self::$instance;
    }
}
