<?php
// src/controllers/AdminRentsController.php

require_once __DIR__ . '/../models/Renta.php';

class AdminRentsController extends BaseAdminController
{
    private Renta $rentaModel;

    public function __construct()
    {
        parent::__construct();
        $this->rentaModel = new Renta();
    }

    /**
     * Listado de rentas (publicadas / ocultas / promocionadas)
     * URL: /dashboard/rents
     */
    public function index(): void
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $page = max(1, $page);

        $q = trim($_GET['q'] ?? '');

        $itemsPerPage = 6;
        $offset       = ($page - 1) * $itemsPerPage;

        $rentasVisibles      = $this->rentaModel->getRentsVisible($itemsPerPage, $offset, $q);
        $totalVisibles       = $this->rentaModel->getTotalRentsVisible($q);
        $totalPages          = (int)ceil($totalVisibles / $itemsPerPage);

        $rentasOcultas       = $this->rentaModel->getRentsHidden($q);
        $rentasPromocionadas = $this->rentaModel->getRentsPromoted($q);

        $currentUser = $this->currentUser();
        $activeMenu  = 'rentas';

        $seo        = $this->buildSeo($page);
        $pageStyles = $this->getPageStyles();

        require __DIR__ . '/../views/admin/rentsView.php';
    }

    /**
     * Promocionar renta
     * URL esperada (con el router que te propuse): POST /dashboard/rents/promoteRent
     */
    public function promoteRent(): void
    {
        $this->ensurePost();

        $id = isset($_POST['rental_id']) ? (int)$_POST['rental_id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de renta inválido.');
        } else {
            $ok = $this->rentaModel->promote($id);
            Session::flash(
                $ok ? 'success' : 'error',
                $ok ? 'Renta promocionada correctamente.' : 'No se pudo promocionar la renta.'
            );
        }

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function unpromoteRent(): void
    {
        $this->ensurePost();

        $id = isset($_POST['rental_id']) ? (int)$_POST['rental_id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de renta inválido.');
        } else {
            $ok = $this->rentaModel->unpromote($id);
            Session::flash(
                $ok ? 'success' : 'error',
                $ok ? 'La renta ya no está promocionada.' : 'No se pudo quitar la promoción.'
            );
        }

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function hideRent(): void
    {
        $this->ensurePost();

        $id = isset($_POST['rental_id']) ? (int)$_POST['rental_id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de renta inválido.');
        } else {
            $ok = $this->rentaModel->hide($id);
            Session::flash(
                $ok ? 'success' : 'error',
                $ok ? 'Renta ocultada correctamente.' : 'No se pudo ocultar la renta.'
            );
        }

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function unhideRent(): void
    {
        $this->ensurePost();

        $id = isset($_POST['rental_id']) ? (int)$_POST['rental_id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de renta inválido.');
        } else {
            $ok = $this->rentaModel->unhide($id);
            Session::flash(
                $ok ? 'success' : 'error',
                $ok ? 'Renta visible nuevamente.' : 'No se pudo mostrar la renta.'
            );
        }

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function deleteRent(): void
    {
        $this->ensurePost();

        $id = isset($_POST['rental_id']) ? (int)$_POST['rental_id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de renta inválido.');
        } else {
            $ok = $this->rentaModel->delete($id);
            Session::flash(
                $ok ? 'success' : 'error',
                $ok ? 'Renta eliminada correctamente.' : 'No se pudo eliminar la renta.'
            );
        }

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function store(): void
    {
        $this->ensurePost();

        $data = [
            'rentalTitle'       => $_POST['rentalTitle']       ?? '',
            'rentalCategory'    => $_POST['rentalCategory']    ?? '',
            'rentalDescription' => $_POST['rentalDescription'] ?? '',
            'rentalPrice'       => $_POST['rentalPrice']       ?? '',
            'rentalPriceType'   => $_POST['rentalPriceType']   ?? '',
            'typeTimeRent'      => $_POST['typeTimeRent']      ?? '',
            'provincia'         => $_POST['provincia1']        ?? '',
            'municipio'         => $_POST['municipio1']        ?? '',
            'habitaciones'      => $_POST['habitaciones']      ?? 0,
            'capacidad'         => $_POST['capacidad']         ?? 0,
            'services'          => $_POST['services']          ?? [],
        ];

        $files = $_FILES['rentalImages'] ?? null;

        $ok = $this->rentaModel->createRent($data, $files);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Renta creada correctamente.' : 'No se pudo crear la renta.'
        );

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function update(): void
    {
        $this->ensurePost();
        $id = (int)($_GET['id'] ?? 0);

        $data = [
            'rentalTitle'       => $_POST['rentalTitle']       ?? '',
            'rentalCategory'    => $_POST['rentalCategory']    ?? '',
            'rentalDescription' => $_POST['rentalDescription'] ?? '',
            'rentalPrice'       => $_POST['rentalPrice']       ?? '',
            'rentalPriceType'   => $_POST['rentalPriceType']   ?? '',
            'typeTimeRent'      => $_POST['typeTimeRent']      ?? '',
            'provincia'         => $_POST['provincia1']        ?? '',
            'municipio'         => $_POST['municipio1']        ?? '',
            'habitaciones'      => $_POST['habitaciones']      ?? 0,
            'capacidad'         => $_POST['capacidad']         ?? 0,
            'services'          => $_POST['services']          ?? [],
            'imagesToDelete' => $_POST['imagesToDelete'] ?? [],
        ];
        $files = $_FILES['rentalImages'] ?? null;

        $ok = $this->rentaModel->updateRent($id, $data, $files);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Renta actualizada correctamente.' : 'No se pudo actualizar la renta.'
        );

        header('Location: ' . BASE_URL . 'dashboard/rents');
        exit;
    }

    public function getRent(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $id   = (int)($_GET['id'] ?? 0);
        $data = $this->rentaModel->getForEdit($id);
        echo json_encode($data ?: ['error' => 'Renta no encontrada']);
        exit;
    }

    // ----------------- Helpers privados -----------------

    private function ensurePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard/rents');
            exit;
        }
    }

    private function buildSeo(int $page): array
    {
        return [
            'title'       => 'Gestión de rentas | Panel CuVaRents',
            'description' => 'Listado de rentas publicadas, ocultas y promocionadas.',
            'keywords'    => 'admin, rentas, panel, cuvarents',
            'url'         => BASE_URL . 'dashboard/rents' . ($page > 1 ? '?page=' . $page : ''),
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_ES',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Dashboard', BASE_URL . 'dashboard'],
                ['Rentas', BASE_URL . 'dashboard/rents'],
            ],
            'pageType'    => 'admin-rents',
        ];
    }

    private function getPageStyles(): array
    {
        return [
            'assets/css/choices.min.css',
            'assets/css/nouislider.min.css',
            'assets/css/file-upload.css',
        ];
    }
}
