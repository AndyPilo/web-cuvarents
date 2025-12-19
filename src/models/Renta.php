<?php
class Renta
{
    private PDO $db;

    public function __construct()
    {
        // Unificamos con el modelo User: usamos Database::getConnection()
        $this->db = Database::connect();
    }

    /**
     * Obtiene las rentas con soporte para categoría y zona (nuevo)
     */
    public function getRentas(
        int $itemsPerPage,
        int $offset,
        string $category = '',
        string $zone = ''
    ): array {
        try {
            // --- Construcción base del WHERE ---
            $where  = "Rentals.is_hidden = FALSE";
            $params = [];

            if (!empty($category)) {
                $where .= " AND Rentals.rental_category = :category";
                $params[':category'] = $category;
            }

            if (!empty($zone)) {
                // Coincidencia con nombre de municipio o provincia
                $where .= " AND (Rentals.rental_municipio LIKE :zone OR Rentals.rental_provincia LIKE :zone)";
                $params[':zone'] = '%' . $zone . '%';
            }

            // --- Consulta principal ---
            $sql = "
                SELECT 
                    Rentals.*, 
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images,
                    GROUP_CONCAT(
                        DISTINCT CONCAT(services_rent.services_rent_icon_svg, '::', services_rent.services_rent_name)
                        ORDER BY services_rent.services_rent_id SEPARATOR '||'
                    ) AS service_data
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                LEFT JOIN RentalServices ON Rentals.rental_id = RentalServices.rental_id
                LEFT JOIN services_rent ON RentalServices.service_rent_id = services_rent.services_rent_id
                WHERE $where
                GROUP BY Rentals.rental_id
                ORDER BY Rentals.is_promoted DESC, Rentals.rental_id DESC
                LIMIT :limit OFFSET :offset
            ";

            $stmt = $this->db->prepare($sql);

            // Bind dinámico
            foreach ($params as $key => $val) {
                $stmt->bindValue($key, $val, PDO::PARAM_STR);
            }
            $stmt->bindValue(':limit',  $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset,       PDO::PARAM_INT);
            $stmt->execute();

            $rentas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // --- Total de resultados ---
            $sqlTotal = "SELECT COUNT(DISTINCT rental_id) FROM Rentals WHERE $where";
            $stmtTotal = $this->db->prepare($sqlTotal);
            foreach ($params as $key => $val) {
                $stmtTotal->bindValue($key, $val, PDO::PARAM_STR);
            }
            $stmtTotal->execute();
            $total      = (int)$stmtTotal->fetchColumn();
            $totalPages = (int)ceil($total / $itemsPerPage);

            return [
                'rentas'     => $rentas,
                'totalPages' => $totalPages,
            ];
        } catch (PDOException $e) {
            error_log("Error en Renta::getRentas(): " . $e->getMessage());
            return ['rentas' => [], 'totalPages' => 0];
        }
    }

    /**
     * Obtiene una renta por ID
     */
    public function getById(int $id): ?array
    {
        try {
            $sql = "
                SELECT 
                    Rentals.*, 
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images,
                    GROUP_CONCAT(
                        DISTINCT CONCAT(services_rent.services_rent_icon_svg, '::', services_rent.services_rent_name)
                        ORDER BY services_rent.services_rent_id SEPARATOR '||'
                    ) AS service_data
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                LEFT JOIN RentalServices ON Rentals.rental_id = RentalServices.rental_id
                LEFT JOIN services_rent ON RentalServices.service_rent_id = services_rent.services_rent_id
                WHERE Rentals.rental_id = :id
                GROUP BY Rentals.rental_id
                LIMIT 1
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $renta = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($renta) {
                // Procesar imágenes
                $renta['images'] = !empty($renta['images'])
                    ? explode(',', $renta['images'])
                    : [];

                // Procesar servicios
                $renta['services'] = [];
                if (!empty($renta['service_data'])) {

                    // Cada servicio viene separado por '||'
                    $pairs = explode('||', $renta['service_data']);

                    foreach ($pairs as $pair) {
                        // Dentro de cada servicio, icono y nombre separados por '::'
                        $parts = explode('::', $pair, 2);
                        $icon  = trim($parts[0] ?? '');
                        $name  = trim($parts[1] ?? '');

                        if ($icon !== '' || $name !== '') {
                            $renta['services'][] = [
                                'icon' => $icon,
                                'name' => $name,
                            ];
                        }
                    }
                }
            }

            return $renta ?: null;
        } catch (PDOException $e) {
            error_log("Error en Renta::getById(): " . $e->getMessage());
            return null;
        }
    }

    /**
     * Obtiene rentas por categoría (para Home)
     */
    public function getByCategory(string $category, int $limit = 4): array
    {
        try {
            $sql = "
                SELECT 
                    Rentals.*, 
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images,
                    GROUP_CONCAT(
                            DISTINCT CONCAT(services_rent.services_rent_icon_svg, '::', services_rent.services_rent_name)
                            ORDER BY services_rent.services_rent_id SEPARATOR '||'
                        ) AS service_data
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                LEFT JOIN RentalServices ON Rentals.rental_id = RentalServices.rental_id
                LEFT JOIN services_rent ON RentalServices.service_rent_id = services_rent.services_rent_id
                WHERE Rentals.is_hidden = FALSE 
                  AND Rentals.rental_category = :category
                GROUP BY Rentals.rental_id
                ORDER BY Rentals.is_promoted DESC, Rentals.rental_id DESC
                LIMIT :limit
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':category', $category, PDO::PARAM_STR);
            $stmt->bindValue(':limit',    $limit,    PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Renta::getByCategory(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Para sitemap
     */
    public function getAllForSitemap(): array
    {
        try {
            $stmt = $this->db->query("SELECT rental_id, rental_title FROM Rentals WHERE is_hidden = FALSE");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Renta::getAllForSitemap(): " . $e->getMessage());
            return [];
        }
    }

    /* =========================================================
       ADMIN: consultas para panel
       ========================================================= */

    public function getUltimasVisibles(int $limit = 2): array
    {
        try {
            $sql = "
                SELECT 
                    Rentals.*, 
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                WHERE Rentals.is_hidden = FALSE
                GROUP BY Rentals.rental_id
                ORDER BY Rentals.rental_id DESC
                LIMIT :limit
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Renta::getUltimasVisibles(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Rentas visibles con paginación para admin (pestaña "Publicadas")
     */
    public function getRentsVisible(int $itemsPerPage, int $offset, string $q = ''): array
    {
        try {
            $params = [];
            $whereSearch = $this->buildAdminSearchWhere($q, $params);

            $sql = "
                SELECT 
                    Rentals.*,
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                WHERE Rentals.is_hidden = FALSE
                $whereSearch
                GROUP BY Rentals.rental_id
                ORDER BY Rentals.rental_id DESC
                LIMIT :limit OFFSET :offset
            ";

            $stmt = $this->db->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, $k === ':qid' ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->bindValue(':limit',  $itemsPerPage, PDO::PARAM_INT);
            $stmt->bindValue(':offset', $offset,       PDO::PARAM_INT);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Renta::getRentsVisible(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Total de rentas visibles (para paginación en admin)
     */
    public function getTotalRentsVisible(string $q = ''): int
    {
        try {
            $params = [];
            $whereSearch = $this->buildAdminSearchWhere($q, $params);

            $sql = "
                SELECT COUNT(DISTINCT Rentals.rental_id) AS total
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                WHERE Rentals.is_hidden = FALSE
                $whereSearch
            ";

            $stmt = $this->db->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, $k === ':qid' ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            return (int)($row['total'] ?? 0);
        } catch (PDOException $e) {
            error_log("Error en Renta::getTotalRentsVisible(): " . $e->getMessage());
            return 0;
        }
    }

    /**
     * Rentas ocultas (is_hidden = TRUE) para pestaña "Ocultas"
     */
    public function getRentsHidden(string $q = ''): array
    {
        try {
            $params = [];
            $whereSearch = $this->buildAdminSearchWhere($q, $params);

            $sql = "
                SELECT 
                    Rentals.*,
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                WHERE Rentals.is_hidden = TRUE
                $whereSearch
                GROUP BY Rentals.rental_id
                ORDER BY Rentals.rental_id DESC
            ";

            $stmt = $this->db->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, $k === ':qid' ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Renta::getRentsHidden(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Rentas promocionadas (is_promoted = TRUE) para pestaña "Promocionadas"
     */
    public function getRentsPromoted(string $q = ''): array
    {
        try {
            $params = [];
            $whereSearch = $this->buildAdminSearchWhere($q, $params);

            $sql = "
                SELECT 
                    Rentals.*,
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images
                FROM Rentals
                LEFT JOIN RentalImages ON Rentals.rental_id = RentalImages.rental_id
                WHERE Rentals.is_promoted = TRUE
                $whereSearch
                GROUP BY Rentals.rental_id
                ORDER BY Rentals.rental_id DESC
            ";

            $stmt = $this->db->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, $k === ':qid' ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error en Renta::getRentsPromoted(): " . $e->getMessage());
            return [];
        }
    }

    /* =========================================================
       ACCIONES ADMIN: PROMOCIONAR / OCULTAR / ELIMINAR
       ========================================================= */

    private function buildAdminSearchWhere(string $q, array &$params): string
    {
        $q = trim($q);
        if ($q === '') {
            return '';
        }

        $params[':q'] = '%' . $q . '%';

        // Abrimos el grupo una sola vez
        $where = " AND (
            Rentals.rental_title LIKE :q
            OR Rentals.rental_provincia LIKE :q
            OR Rentals.rental_municipio LIKE :q
        ";

        // Si el usuario escribió un ID numérico, lo metemos dentro del mismo grupo
        if (ctype_digit($q)) {
            $params[':qid'] = (int)$q;
            $where .= " OR Rentals.rental_id = :qid ";
        }

        // Cerramos el grupo UNA sola vez
        $where .= ")";

        return $where;
    }

    public function promote(int $rentalId): bool
    {
        try {
            $sql = "
                UPDATE Rentals
                SET is_promoted = TRUE,
                    is_hidden   = FALSE
                WHERE rental_id = :id
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Renta::promote(): " . $e->getMessage());
            return false;
        }
    }

    public function unpromote(int $rentalId): bool
    {
        try {
            $sql = "UPDATE Rentals SET is_promoted = FALSE WHERE rental_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Renta::unpromote(): " . $e->getMessage());
            return false;
        }
    }

    public function hide(int $rentalId): bool
    {
        try {
            $sql = "
                UPDATE Rentals
                SET is_hidden   = TRUE,
                    is_promoted = FALSE
                WHERE rental_id = :id
            ";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Renta::hide(): " . $e->getMessage());
            return false;
        }
    }

    public function unhide(int $rentalId): bool
    {
        try {
            $sql = "UPDATE Rentals SET is_hidden = FALSE WHERE rental_id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en Renta::unhide(): " . $e->getMessage());
            return false;
        }
    }

    public function delete(int $rentalId): bool
    {
        try {
            $this->db->beginTransaction();

            // 1) Obtener imágenes asociadas
            $stmtImg = $this->db->prepare("
                SELECT image_url
                FROM RentalImages
                WHERE rental_id = :id
            ");
            $stmtImg->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmtImg->execute();
            $images = $stmtImg->fetchAll(PDO::FETCH_COLUMN) ?: [];

            // 2) Eliminar archivos físicos 
            $uploadsDir = __DIR__ . '/../../uploads/';
            foreach ($images as $img) {
                $filePath = $uploadsDir . $img;
                if (is_file($filePath)) {
                    @unlink($filePath);
                }
            }

            // 3) Eliminar imágenes de la base de datos
            $stmt = $this->db->prepare("DELETE FROM RentalImages WHERE rental_id = :id");
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmt->execute();

            // 4) Eliminar servicios asociados
            $stmt = $this->db->prepare("DELETE FROM RentalServices WHERE rental_id = :id");
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmt->execute();

            // 5) Eliminar la renta
            $stmt = $this->db->prepare("DELETE FROM Rentals WHERE rental_id = :id");
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmt->execute();

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            error_log("Error en Renta::delete(): " . $e->getMessage());
            return false;
        }
    }

    public function createRent(array $data, ?array $files): bool
    {
        // Validación mínima de provincia / municipio 
        $provincia = trim($data['provincia']  ?? '');
        $municipio = trim($data['municipio']  ?? '');

        if ($provincia === '' || $municipio === '') {
            // El controller decidirá qué mensaje mostrar si esto falla
            return false;
        }

        try {
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
            }

            $sql = "
                INSERT INTO Rentals (
                    rental_title,
                    rental_category,
                    rental_description,
                    rental_price,
                    rental_price_type,
                    type_time_rent,
                    rental_location,
                    rental_provincia,
                    rental_municipio,
                    rental_rooms,
                    rental_capacity
                ) VALUES (
                    :title,
                    :category,
                    :description,
                    :price,
                    :priceType,
                    :typeTime,
                    'Oculto',
                    :provincia,
                    :municipio,
                    :rooms,
                    :capacity
                )
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':title',       $data['rentalTitle']       ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':category',    $data['rentalCategory']    ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['rentalDescription'] ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':price',       $data['rentalPrice']       ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':priceType',   $data['rentalPriceType']   ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':typeTime',    $data['typeTimeRent']      ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':provincia',   $provincia,                      PDO::PARAM_STR);
            $stmt->bindValue(':municipio',   $municipio,                      PDO::PARAM_STR);
            $stmt->bindValue(':rooms',      (int)($data['habitaciones'] ?? 0), PDO::PARAM_INT);
            $stmt->bindValue(':capacity',   (int)($data['capacidad']    ?? 0), PDO::PARAM_INT);

            $stmt->execute();
            $rentalId = (int)$this->db->lastInsertId();

            // Guardar imágenes (si hay)
            $this->saveImagesForRental($rentalId, $data['rentalTitle'] ?? '', $files);

            // Guardar servicios seleccionados
            $services = $data['services'] ?? [];
            $this->syncRentalServices($rentalId, $services);

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log('Error en Renta::createFromForm(): ' . $e->getMessage());
            return false;
        }
    }

    public function updateRent(int $rentalId, array $data, ?array $files): bool
    {
        if ($rentalId <= 0) {
            return false;
        }

        try {
            if (!$this->db->inTransaction()) {
                $this->db->beginTransaction();
            }

            $provincia = trim($data['provincia']  ?? '');
            $municipio = trim($data['municipio']  ?? '');

            $sql = "
                UPDATE Rentals
                SET 
                    rental_title       = :title,
                    rental_category    = :category,
                    rental_description = :description,
                    rental_price       = :price,
                    rental_price_type  = :priceType,
                    type_time_rent     = :typeTime,
                    rental_provincia   = :provincia,
                    rental_municipio   = :municipio,
                    rental_rooms       = :rooms,
                    rental_capacity    = :capacity
                WHERE rental_id = :id
            ";

            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':title',       $data['rentalTitle']       ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':category',    $data['rentalCategory']    ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':description', $data['rentalDescription'] ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':price',       $data['rentalPrice']       ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':priceType',   $data['rentalPriceType']   ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':typeTime',    $data['typeTimeRent']      ?? '', PDO::PARAM_STR);
            $stmt->bindValue(':provincia',   $provincia,                      PDO::PARAM_STR);
            $stmt->bindValue(':municipio',   $municipio,                      PDO::PARAM_STR);
            $stmt->bindValue(':rooms',      (int)($data['habitaciones'] ?? 0), PDO::PARAM_INT);
            $stmt->bindValue(':capacity',   (int)($data['capacidad']    ?? 0), PDO::PARAM_INT);
            $stmt->bindValue(':id',          $rentalId,                       PDO::PARAM_INT);

            $stmt->execute();

            // 1) Eliminar imágenes marcadas
            $imagesToDelete = $data['imagesToDelete'] ?? [];
            $this->deleteImagesByIds($rentalId, $imagesToDelete);

            // 2) Subir nuevas imágenes
            $this->saveImagesForRental($rentalId, $data['rentalTitle'] ?? '', $files);

            // 3) Actualizar servicios
            $services = $data['services'] ?? [];
            $this->syncRentalServices($rentalId, $services);

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            if ($this->db->inTransaction()) {
                $this->db->rollBack();
            }
            error_log('Error en Renta::updateFromForm(): ' . $e->getMessage());
            return false;
        }
    }

    /**
     * Datos para el modal de edición 
     */
    public function getForEdit(int $rentalId): ?array
    {
        if ($rentalId <= 0) {
            return null;
        }

        try {
            // 1) Renta
            $sql = "SELECT * FROM Rentals WHERE rental_id = :id LIMIT 1";
            $stmt = $this->db->prepare($sql);
            $stmt->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmt->execute();

            $rental = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$rental) {
                return null;
            }

            // 2) Servicios seleccionados
            $sqlServices = "
                SELECT service_rent_id 
                FROM RentalServices 
                WHERE rental_id = :id
            ";
            $stmtSrv = $this->db->prepare($sqlServices);
            $stmtSrv->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmtSrv->execute();

            $selectedServices = [];
            while ($row = $stmtSrv->fetch(PDO::FETCH_ASSOC)) {
                $selectedServices[] = (int)$row['service_rent_id'];
            }

            // 3) Imágenes asociadas
            $sqlImages = "
                SELECT image_id, image_url 
                FROM RentalImages 
                WHERE rental_id = :id
            ";
            $stmtImg = $this->db->prepare($sqlImages);
            $stmtImg->bindValue(':id', $rentalId, PDO::PARAM_INT);
            $stmtImg->execute();

            $images = [];
            while ($rowImg = $stmtImg->fetch(PDO::FETCH_ASSOC)) {
                $images[] = [
                    'id'  => (int)$rowImg['image_id'],
                    'url' => $rowImg['image_url'],
                ];
            }

            // 4) Construir respuesta esperada por rentalModal.js
            return [
                'rentalTitle'       => $rental['rental_title']       ?? '',
                'rentalDescription' => $rental['rental_description'] ?? '',
                'rentalPrice'       => $rental['rental_price']       ?? '',
                'rentalPriceType'   => $rental['rental_price_type']  ?? '',
                'typeTimeRent'      => $rental['type_time_rent']     ?? '',
                'rentalLocation'    => $rental['rental_location']    ?? '',
                'category'          => $rental['rental_category']    ?? '',
                'provincia'         => $rental['rental_provincia']   ?? '',
                'municipio'         => $rental['rental_municipio']   ?? '',
                'habitaciones'      => (int)($rental['rental_rooms']    ?? 0),
                'capacidad'         => (int)($rental['rental_capacity'] ?? 0),
                'selectedServices'  => $selectedServices,
                'images'            => $images,
            ];
        } catch (PDOException $e) {
            error_log('Error en Renta::getForEdit(): ' . $e->getMessage());
            return null;
        }
    }

     /* =========================================================
       Helpers privados para imágenes y servicios
       ========================================================= */

    /**
     * Directorio físico donde se guardan las imágenes
     */
    private function getUploadsDir(): string
    {
        // Igual que en delete(): __DIR__ . '/../../uploads/'
        return __DIR__ . '/../../uploads/';
    }

    /**
     * Crea slug a partir del título (para nombre de archivo)
     */
    private function slugify(string $text): string
    {
        $text = preg_replace('~[^\pL0-9]+~u', '-', $text);
        $text = trim($text, '-');
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
        $text = strtolower($text);
        $text = preg_replace('~[^-a-z0-9]+~', '', $text);

        return $text ?: 'renta';
    }

    /**
     * Redimensiona una imagen (como en php-add-rent/php-edit-rent)
     */
    private function resizeImage(string $sourcePath, string $destinationPath, int $maxWidth = 1200, int $quality = 85): bool
    {
        $info = @getimagesize($sourcePath);
        if ($info === false) {
            return false;
        }

        [$origWidth, $origHeight] = $info;
        $mime = $info['mime'] ?? '';

        // Si es más pequeña que el maxWidth, solo mover
        if ($origWidth <= $maxWidth) {
            return move_uploaded_file($sourcePath, $destinationPath);
        }

        $newWidth  = $maxWidth;
        $newHeight = (int)(($origHeight / $origWidth) * $newWidth);

        switch ($mime) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($sourcePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($sourcePath);
                break;
            case 'image/webp':
                $image = imagecreatefromwebp($sourcePath);
                break;
            default:
                return false;
        }

        $resized = imagecreatetruecolor($newWidth, $newHeight);

        if ($mime === 'image/png') {
            imagealphablending($resized, false);
            imagesavealpha($resized, true);
        }

        imagecopyresampled(
            $resized,
            $image,
            0,
            0,
            0,
            0,
            $newWidth,
            $newHeight,
            $origWidth,
            $origHeight
        );

        switch ($mime) {
            case 'image/jpeg':
                imagejpeg($resized, $destinationPath, $quality);
                break;
            case 'image/png':
                imagepng($resized, $destinationPath, 8);
                break;
            case 'image/webp':
                imagewebp($resized, $destinationPath, $quality);
                break;
        }

        imagedestroy($image);
        imagedestroy($resized);

        // Eliminamos el tmp si aún existe
        if (is_file($sourcePath)) {
            @unlink($sourcePath);
        }

        return true;
    }

    private function saveImagesForRental(int $rentalId, string $rentalTitle, ?array $files): void
    {
        if (!$files || empty($files['tmp_name']) || !is_array($files['tmp_name'])) {
            return;
        }

        $uploadsDir = $this->getUploadsDir();
        if (!is_dir($uploadsDir)) {
            @mkdir($uploadsDir, 0755, true);
        }

        $allowedExts = ['jpg', 'jpeg', 'png', 'webp'];
        $baseName    = $this->slugify($rentalTitle);

        foreach ($files['tmp_name'] as $key => $tmpName) {
            if (empty($tmpName) || !is_uploaded_file($tmpName)) {
                continue;
            }

            $originalName = $files['name'][$key] ?? '';
            $fileExt      = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            if (!in_array($fileExt, $allowedExts, true)) {
                continue;
            }

            if (!@getimagesize($tmpName)) {
                continue;
            }

            $uniqueFileName  = $baseName . '-' . uniqid('', true) . '.' . $fileExt;
            $targetFilePath  = $uploadsDir . $uniqueFileName;

            if ($this->resizeImage($tmpName, $targetFilePath)) {
                $sqlImg = "
                    INSERT INTO RentalImages (rental_id, image_url)
                    VALUES (:rental_id, :image_url)
                ";
                $stmtImg = $this->db->prepare($sqlImg);
                $stmtImg->bindValue(':rental_id', $rentalId,        PDO::PARAM_INT);
                $stmtImg->bindValue(':image_url', $uniqueFileName, PDO::PARAM_STR);
                $stmtImg->execute();
            }
        }
    }

    /**
     * Elimina físicamente + BD las imágenes indicadas por ID para una renta
     */
    private function deleteImagesByIds(int $rentalId, array $imageIds): void
    {
        if ($rentalId <= 0 || empty($imageIds)) {
            return;
        }

        $uploadsDir = $this->getUploadsDir();

        foreach ($imageIds as $imageId) {
            $imageId = (int)$imageId;
            if ($imageId <= 0) {
                continue;
            }

            // Obtener nombre de archivo
            $sql    = "SELECT image_url FROM RentalImages WHERE image_id = :imgId AND rental_id = :rentId";
            $stmt   = $this->db->prepare($sql);
            $stmt->bindValue(':imgId',  $imageId,  PDO::PARAM_INT);
            $stmt->bindValue(':rentId', $rentalId, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($row && !empty($row['image_url'])) {
                $filePath = $uploadsDir . $row['image_url'];
                if (is_file($filePath)) {
                    @unlink($filePath);
                }

                // Eliminar registro
                $sqlDel = "DELETE FROM RentalImages WHERE image_id = :imgId AND rental_id = :rentId";
                $stmtDel = $this->db->prepare($sqlDel);
                $stmtDel->bindValue(':imgId',  $imageId,  PDO::PARAM_INT);
                $stmtDel->bindValue(':rentId', $rentalId, PDO::PARAM_INT);
                $stmtDel->execute();
            }
        }
    }

    /**
     * Sincroniza servicios de una renta (borra todos y vuelve a insertar los nuevos)
     */
    private function syncRentalServices(int $rentalId, array $services): void
    {
        // Borramos todos los servicios previos
        $sqlDel = "DELETE FROM RentalServices WHERE rental_id = :id";
        $stmtDel = $this->db->prepare($sqlDel);
        $stmtDel->bindValue(':id', $rentalId, PDO::PARAM_INT);
        $stmtDel->execute();

        if (empty($services)) {
            return;
        }

        $sqlIns = "
            INSERT INTO RentalServices (rental_id, service_rent_id)
            VALUES (:rental_id, :service_id)
        ";
        $stmtIns = $this->db->prepare($sqlIns);

        foreach ($services as $serviceId) {
            $serviceId = (int)$serviceId;
            if ($serviceId <= 0) {
                continue;
            }

            $stmtIns->bindValue(':rental_id',  $rentalId,  PDO::PARAM_INT);
            $stmtIns->bindValue(':service_id', $serviceId, PDO::PARAM_INT);
            $stmtIns->execute();
        }
    }
}
