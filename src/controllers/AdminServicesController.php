<?php
// src/controllers/AdminServicesController.php

require_once __DIR__ . '/../models/Service.php';

class AdminServicesController extends BaseAdminController
{
    private Service $serviceModel;

    public function __construct()
    {
        parent::__construct();
        $this->serviceModel = new Service();
    }

    /**
     * Listado de servicios + modal para crear
     * URL: GET /dashboard/services
     */
    public function index(): void
    {
        $currentUser = $this->currentUser();
        $activeMenu  = 'services';

        $services   = $this->serviceModel->getAllServices();
        $seo        = $this->buildSeo();
        $pageStyles = $this->getPageStyles();

        require __DIR__ . '/../views/admin/servicesView.php';
    }

    /**
     * Crear servicio
     * URL: POST /dashboard/services/store
     */
    public function store(): void
    {
        $this->ensurePost();

        $name = trim($_POST['serviceName'] ?? '');
        $icon = $_POST['serviceIcon'] ?? '';

        if ($name === '' || $icon === '') {
            Session::flash('error', 'Nombre e icono del servicio son obligatorios.');
            header('Location: ' . BASE_URL . 'dashboard/services');
            exit;
        }

        $ok = $this->serviceModel->create($name, $icon);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Servicio creado correctamente.' : 'No se pudo crear el servicio.'
        );

        header('Location: ' . BASE_URL . 'dashboard/services');
        exit;
    }

    /**
     * Eliminar servicio
     * URL: POST /dashboard/services/delete
     */
    public function delete(): void
    {
        $this->ensurePost();

        $id = isset($_POST['service_id']) ? (int)$_POST['service_id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de servicio inválido.');
            header('Location: ' . BASE_URL . 'dashboard/services');
            exit;
        }

        $ok = $this->serviceModel->delete($id);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Servicio eliminado correctamente.' : 'No se pudo eliminar el servicio.'
        );

        header('Location: ' . BASE_URL . 'dashboard/services');
        exit;
    }

    public function json(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        try {
            $services = $this->serviceModel->getAllServices();
            echo json_encode($services);
        } catch (Throwable $e) {
            error_log('Error en AdminServicesController::json(): ' . $e->getMessage());
            echo json_encode([]);
        }

        exit;
    }

    // ----------------- Helpers privados -----------------

    private function ensurePost(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard/services');
            exit;
        }
    }

    private function buildSeo(): array
    {
        return [
            'title'       => 'Servicios de rentas | Panel CuVaRents',
            'description' => 'Gestión de servicios asociados a las rentas.',
            'keywords'    => 'admin, servicios, comodities, cuvarents',
            'url'         => BASE_URL . 'dashboard/services',
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_ES',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Dashboard', BASE_URL . 'dashboard'],
                ['Servicios', BASE_URL . 'dashboard/services'],
            ],
            'pageType'    => 'admin-services',
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
