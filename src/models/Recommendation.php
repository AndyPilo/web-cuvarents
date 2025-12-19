<?php
class Recommendation
{
    private PDO $db;

    public function __construct()
    {
        // Usa el mismo helper que Renta (Database::connect())
        $this->db = Database::connect();
    }

    /**
     * Todas las recomendaciones (admin)
     */
    public function getAll(): array
    {
        try {
            $sql = "SELECT * FROM Recommendations ORDER BY created_at DESC";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log('Error en Recommendation::getAll(): ' . $e->getMessage());
            return [];
        }
    }

    /**
     * Última recomendación (para el dashboard)
     */
    public function getUltima(): ?array
    {
        try {
            $sql = "SELECT * FROM Recommendations ORDER BY created_at DESC LIMIT 1";
            $stmt = $this->db->query($sql);
            $row  = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row ?: null;
        } catch (PDOException $e) {
            error_log('Error en Recommendation::getUltima(): ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crear recomendación
     */
    public function create(array $data): bool
    {
        try {
            $sql = "
                INSERT INTO Recommendations (user_name, user_rank, recommendation_text, created_at)
                VALUES (:user_name, :user_rank, :recommendation_text, NOW())
            ";
            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':user_name'          => $data['user_name'],
                ':user_rank'          => $data['user_rank'],
                ':recommendation_text' => $data['recommendation_text'],
            ]);
        } catch (PDOException $e) {
            error_log('Error en Recommendation::create(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Eliminar recomendación por ID
     */
    public function delete(int $id): bool
    {
        try {
            $sql = "DELETE FROM Recommendations WHERE recommendation_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            error_log('Error en Recommendation::delete(): ' . $e->getMessage());
            return false;
        }
    }
}
