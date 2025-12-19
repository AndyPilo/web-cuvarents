<?php
class Search
{
    private PDO $db;

    public function __construct()
    {
        $this->db = Database::connect();
    }

    /** Obtiene todas las zonas (municipios) únicas donde hay rentas */
    public function obtenerZonas(): array
    {
        try {
            $sql = "
                SELECT DISTINCT rental_municipio
                FROM Rentals
                WHERE is_hidden = 0
                  AND rental_municipio IS NOT NULL
                  AND TRIM(rental_municipio) <> ''
                ORDER BY rental_municipio ASC
            ";
            $stmt = $this->db->query($sql);
            $zonas = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            $zonas = array_filter(array_unique(array_map('trim', $zonas)));
            return $zonas ?: [];
        } catch (PDOException $e) {
            error_log("Error en Search::obtenerZonas(): " . $e->getMessage());
            return [];
        }
    }

    /** Obtiene todas las provincias únicas donde hay rentas */
    public function obtenerProvincias(): array
    {
        try {
            $sql = "
                SELECT DISTINCT rental_provincia
                FROM Rentals
                WHERE is_hidden = 0
                  AND rental_provincia IS NOT NULL
                  AND TRIM(rental_provincia) <> ''
                ORDER BY rental_provincia ASC
            ";
            $stmt = $this->db->query($sql);
            $provincias = $stmt->fetchAll(PDO::FETCH_COLUMN, 0);

            $provincias = array_filter(array_unique(array_map('trim', $provincias)));
            return $provincias ?: [];
        } catch (PDOException $e) {
            error_log("Error en Search::obtenerProvincias(): " . $e->getMessage());
            return [];
        }
    }

    /** Pares provincia/municipio (para dependencia en UI) */
    public function obtenerZonasConProvincia(): array
    {
        try {
            $sql = "
                SELECT DISTINCT
                    TRIM(rental_provincia) AS provincia,
                    TRIM(rental_municipio) AS municipio
                FROM Rentals
                WHERE is_hidden = 0
                  AND rental_provincia IS NOT NULL AND TRIM(rental_provincia) <> ''
                  AND rental_municipio IS NOT NULL AND TRIM(rental_municipio) <> ''
                ORDER BY provincia ASC, municipio ASC
            ";
            $stmt = $this->db->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC) ?: [];
        } catch (PDOException $e) {
            error_log("Error en Search::obtenerZonasConProvincia(): " . $e->getMessage());
            return [];
        }
    }

    /**
     * Buscar propiedades
     *
     * Nuevo enfoque:
     * - provincia: SOLO UNA (string)
     * - municipios: array (multi)
     *
     * Reglas:
     * - Si hay provincia y municipios => AND (provincia + municipios)
     * - Si hay solo provincia => provincia
     * - Si hay solo municipios => municipios
     */
    public function buscarPropiedades(array $filtros = [], int $limit = 12, int $offset = 0): array
    {
        try {
            $select = "
                SELECT
                    Rentals.*,
                    GROUP_CONCAT(DISTINCT RentalImages.image_url) AS images,
                    GROUP_CONCAT(
                        DISTINCT CONCAT(services_rent.services_rent_icon_svg, '::', services_rent.services_rent_name)
                        ORDER BY services_rent.services_rent_id
                        SEPARATOR '||'
                    ) AS service_data
                FROM Rentals
                LEFT JOIN RentalImages
                    ON Rentals.rental_id = RentalImages.rental_id
                LEFT JOIN RentalServices RS
                    ON Rentals.rental_id = RS.rental_id
                LEFT JOIN services_rent
                    ON RS.service_rent_id = services_rent.services_rent_id
                WHERE Rentals.is_hidden = 0
            ";

            $where  = [];
            $params = [];

            // -----------------------
            // Ubicación (AND, jerárquico)
            // -----------------------

            // Provincia (SOLA UNA)
            $provincia = trim((string)($filtros['provincia'] ?? ''));
            if ($provincia !== '') {
                $where[] = "Rentals.rental_provincia = :provincia";
                $params[':provincia'] = $provincia;
            }

            // Municipios (multi)
            $municipiosRaw = $filtros['municipios'] ?? [];
            $municipios = is_array($municipiosRaw) ? $municipiosRaw : [$municipiosRaw];
            $municipios = array_values(array_filter(array_map('trim', $municipios), fn($v) => $v !== ''));

            if (!empty($municipios)) {
                $in = [];
                foreach ($municipios as $i => $m) {
                    $key = ":mun_$i";
                    $in[] = $key;
                    $params[$key] = $m;
                }
                $where[] = "Rentals.rental_municipio IN (" . implode(',', $in) . ")";
            }

            // ---------------------------------------
            // Precio (OR de tramos)
            // ---------------------------------------
            if (!empty($filtros['precios']) && is_array($filtros['precios'])) {
                $priceConds = [];
                $rangeIdx = 0;

                foreach ($filtros['precios'] as $p) {
                    $p = trim((string)$p);

                    if ($p === '<50') {
                        $priceConds[] = "Rentals.rental_price < 50";
                    } elseif ($p === '>200') {
                        $priceConds[] = "Rentals.rental_price > 200";
                    } elseif (preg_match('/^(\d+)-(\d+)$/', $p, $m)) {
                        $a = (int)$m[1];
                        $b = (int)$m[2];

                        $ka = ":price_from_$rangeIdx";
                        $kb = ":price_to_$rangeIdx";

                        $priceConds[] = "(Rentals.rental_price BETWEEN $ka AND $kb)";
                        $params[$ka] = $a;
                        $params[$kb] = $b;
                        $rangeIdx++;
                    }
                }

                if (!empty($priceConds)) {
                    $where[] = '(' . implode(' OR ', $priceConds) . ')';
                }
            }

            // ---------------------------------------
            // Habitaciones (>=)
            // ---------------------------------------
            if (!empty($filtros['habitaciones'])) {
                $where[] = "Rentals.rental_rooms >= :rooms";
                $params[':rooms'] = (int)$filtros['habitaciones'];
            }

            // ---------------------------------------
            // Capacidad (>=)
            // ---------------------------------------
            if (!empty($filtros['capacidad'])) {
                $where[] = "Rentals.rental_capacity >= :capacity";
                $params[':capacity'] = (int)$filtros['capacidad'];
            }

            // ---------------------------------------
            // Servicios: requiere TODOS (tu lógica)
            // ---------------------------------------
            if (!empty($filtros['servicios']) && is_array($filtros['servicios'])) {
                $servicios = array_values(array_filter($filtros['servicios'], fn($v) => $v !== ''));
                if (!empty($servicios)) {
                    $inServ = [];
                    foreach ($servicios as $i => $s) {
                        $key = ":srv_$i";
                        $inServ[] = $key;
                        $params[$key] = (int)$s;
                    }

                    $where[] = "Rentals.rental_id IN (
                        SELECT rental_id
                        FROM RentalServices
                        WHERE service_rent_id IN (" . implode(',', $inServ) . ")
                        GROUP BY rental_id
                        HAVING COUNT(DISTINCT service_rent_id) = " . count($servicios) . "
                    )";
                }
            }

            // Construcción SQL completa
            $sql = $select;
            if (!empty($where)) {
                $sql .= "\nAND " . implode("\nAND ", $where);
            }

            $sql .= "\nGROUP BY Rentals.rental_id";
            $sql .= "\nORDER BY Rentals.is_promoted DESC, Rentals.rental_id DESC";
            $sql .= "\nLIMIT :_limit OFFSET :_offset";

            // Ejecutar listado
            $stmt = $this->db->prepare($sql);

            foreach ($params as $k => $v) {
                $stmt->bindValue($k, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $stmt->bindValue(':_limit', (int)$limit, PDO::PARAM_INT);
            $stmt->bindValue(':_offset', (int)$offset, PDO::PARAM_INT);

            $stmt->execute();
            $rentas = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // ---- COUNT total (misma WHERE, sin GROUP BY ni LIMIT) ----
            $countSql = "
                SELECT COUNT(DISTINCT Rentals.rental_id) AS total
                FROM Rentals
                LEFT JOIN RentalServices RS
                    ON Rentals.rental_id = RS.rental_id
                WHERE Rentals.is_hidden = 0
            ";

            if (!empty($where)) {
                $countSql .= "\nAND " . implode("\nAND ", $where);
            }

            $countStmt = $this->db->prepare($countSql);
            foreach ($params as $k => $v) {
                $countStmt->bindValue($k, $v, is_int($v) ? PDO::PARAM_INT : PDO::PARAM_STR);
            }

            $countStmt->execute();
            $total = (int)$countStmt->fetchColumn();
            $totalPages = max(1, (int)ceil($total / max(1, $limit)));

            return [
                'rentas' => $rentas,
                'totalPages' => $totalPages
            ];
        } catch (PDOException $e) {
            error_log("Error en Search::buscarPropiedades(): " . $e->getMessage());
            return ['rentas' => [], 'totalPages' => 1];
        }
    }
}
