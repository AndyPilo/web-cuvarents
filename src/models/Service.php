<?php

class Service
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    public function getAllServices(): array
    {
        $query = "
            SELECT 
                services_rent_id       AS id,
                services_rent_name     AS name,
                services_rent_icon_svg AS icon
            FROM services_rent
            ORDER BY services_rent_name ASC
        ";

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create(string $name, string $iconHtml): bool
    {
        try {
            $sql = "
                INSERT INTO services_rent (services_rent_name, services_rent_icon_svg)
                VALUES (:name, :icon)
            ";

            $stmt = $this->db->prepare($sql);

            return $stmt->execute([
                ':name' => $name,
                ':icon' => $iconHtml,
            ]);
        } catch (PDOException $e) {
            error_log('Error en Service::create(): ' . $e->getMessage());
            return false;
        }
    }

    public function delete(int $id): bool
    {
        try {
            // Iniciar transacción
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
            }

            $sqlRentalServices = "
                DELETE FROM RentalServices
                WHERE service_rent_id = :id
            ";
            $stmt = $this->db->prepare($sqlRentalServices);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $sqlService = "
                DELETE FROM services_rent
                WHERE services_rent_id = :id
            ";
            $stmt = $this->db->prepare($sqlService);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();

            $deleted = $stmt->rowCount() > 0;

            $this->db->commit();

            return $deleted;
        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }

            error_log('Error en Service::delete(): ' . $e->getMessage());
            return false;
        }
    }
}
