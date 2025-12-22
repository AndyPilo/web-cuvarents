<?php
// src/controllers/AdminBookingController.php
declare(strict_types=1);

require_once __DIR__ . '/../models/Gestor.php';

class AdminBookingController extends BaseAdminController
{
    private Gestor $gestorModel;

    public function __construct()
    {
        parent::__construct(); // Solo admins
        $this->gestorModel = new Gestor();
    }

    /**
     * Listado de gestores + formulario para crear
     * URL: GET /dashboard/reservas
     */
    public function index(): void
    {
        $currentUser = $this->currentUser();
        $activeMenu  = 'reservas';

        $gestores = $this->gestorModel->getAll();

        $seo        = $this->buildSeo();
        $pageStyles = $this->getPageStyles();

        require __DIR__ . '/../views/admin/bookingView.php';
    }

    /**
     * Crear nuevo gestor
     * URL: POST /dashboard/reservas/store
     */
    public function store(): void
    {
        $this->ensurePost();

        $nombre   = trim($_POST['nombre']   ?? '');
        $telefono = trim($_POST['telefono'] ?? '');

        if ($nombre === '' || $telefono === '') {
            Session::flash('error', 'Nombre y teléfono son obligatorios.');
            header('Location: ' . BASE_URL . 'dashboard/reservas');
            exit;
        }

        $ok = $this->gestorModel->create($nombre, $telefono);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Gestor creado correctamente.' : 'No se pudo crear el gestor.'
        );

        header('Location: ' . BASE_URL . 'dashboard/reservas');
        exit;
    }

    /**
     * Activar gestor
     * URL: POST /dashboard/reservas/activate
     */
    public function activate(): void
    {
        $this->ensurePost();

        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de gestor inválido.');
            header('Location: ' . BASE_URL . 'dashboard/reservas');
            exit;
        }

        $ok = $this->gestorModel->activate($id);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Gestor activado correctamente.' : 'No se pudo activar el gestor.'
        );

        header('Location: ' . BASE_URL . 'dashboard/reservas');
        exit;
    }

    /**
     * Eliminar gestor (solo si no está activo)
     * URL: POST /dashboard/reservas/delete
     */
    public function delete(): void
    {
        $this->ensurePost();

        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de gestor inválido.');
            header('Location: ' . BASE_URL . 'dashboard/profile');
            exit;
        }

        $ok = $this->gestorModel->delete($id);

        if ($ok) {
            Session::flash('success', 'Gestor eliminado correctamente.');
        } else {
            Session::flash(
                'error',
                'No se pudo eliminar el gestor. Asegúrate de que no esté activo o que exista.'
            );
        }

        header('Location: ' . BASE_URL . 'dashboard/profile');
        exit;
    }

    // ----------------- Helpers privados -----------------

    private function ensurePost(): void
    {
        if (($_SERVER['REQUEST_METHOD'] ?? 'GET') !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard/reservas');
            exit;
        }
    }

    private function buildSeo(): array
    {
        return [
            'title'       => 'Reservas | Panel CuVaRents',
            'description' => 'Gestión de gestores encargados de las reservas.',
            'keywords'    => 'admin, reservas, gestores, cuvarents',
            'url'         => BASE_URL . 'dashboard/reservas',
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_CU',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Dashboard', BASE_URL . 'dashboard'],
                ['Reservas', BASE_URL . 'dashboard/reservas'],
            ],
            'pageType'    => 'admin-reservas',
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
