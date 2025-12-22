<?php
require_once __DIR__ . '/../models/Gestor.php';

class AdminProfileController extends BaseAdminController
{
    private Gestor $gestorModel;

    public function __construct()
    {
        parent::__construct();
        $this->gestorModel = new Gestor();
    }

    /**
     * Perfil / configuración de la web
     * URL: GET /dashboard/profile
     */
    public function index(): void
    {
        $currentUser = $this->currentUser();
        $activeMenu  = 'profile';

        // Gestores para la pestaña "Configuración de reservas"
        $gestores = $this->gestorModel->getAll();

        $seo = [
            'title'       => 'Configuración de la web | Panel CuVaRents',
            'description' => 'Perfil del administrador y configuración de reservas.',
            'keywords'    => 'admin, perfil, configuración, reservas, cuvarents',
            'url'         => BASE_URL . 'dashboard/profile',
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_CU',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Dashboard', BASE_URL . 'dashboard'],
                ['Perfil', BASE_URL . 'dashboard/profile'],
            ],
            'pageType'    => 'admin-profile',
        ];

        $pageStyles = [
            'assets/css/choices.min.css',
            'assets/css/nouislider.min.css',
            'assets/css/file-upload.css',
        ];

        require __DIR__ . '/../views/admin/profileView.php';
    }
}
