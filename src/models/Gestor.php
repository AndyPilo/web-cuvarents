<?php
require_once __DIR__ . '/../../config/database.php';

class Gestor
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getActivo(): ?array
    {
        try {
            $sql  = "SELECT * FROM Gestores WHERE activo = 1 LIMIT 1";
            $stmt = $this->db->query($sql);
            $gestor = $stmt->fetch(PDO::FETCH_ASSOC);
            return $gestor ?: null;
        } catch (PDOException $e) {
            error_log("Error en Gestor::getActivo() - " . $e->getMessage());
            return null;
        }
    }

    /**
     * Devuelve todos los gestores
     */
    public function getAll(): array
    {
        try {
            $sql  = "SELECT * FROM Gestores ORDER BY id ASC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log('Error en Gestor::getAll(): ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Crear un nuevo gestor (por defecto activo = 0)
     */
    public function create(string $nombre, string $telefono): bool
    {
        try {
            $sql = "
                INSERT INTO Gestores (nombre, telefono, activo)
                VALUES (:nombre, :telefono, 0)
            ";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':nombre'   => $nombre,
                ':telefono' => $telefono,
            ]);
        } catch (PDOException $e) {
            error_log('Error en Gestor::create(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Activar un gestor y desactivar el resto (igual que php-activar-gestor.php)
     */
    public function activate(int $id): bool
    {
        try {
            $this->db->beginTransaction();

            // Desactivar todos
            $this->db->exec("UPDATE Gestores SET activo = 0");

            // Activar el seleccionado
            $sql  = "UPDATE Gestores SET activo = 1 WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            if ($stmt->rowCount() === 0) {
                // No se activó nadie → rollback
                $this->db->rollBack();
                return false;
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log('Error en Gestor::activate(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar gestor solo si NO está activo
     */
    public function delete(int $id): bool
    {
        try {
            // Solo borra si activo = 0 (mismo criterio que el proyecto antiguo)
            $sql  = "DELETE FROM Gestores WHERE id = :id AND activo = 0";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error en Gestor::delete(): ' . $e->getMessage());
            return false;
        }
    }
}
