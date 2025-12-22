<?php
// src/controllers/DashboardController.php
declare(strict_types=1);

require_once __DIR__ . '/../models/Renta.php';
require_once __DIR__ . '/../models/Recommendation.php';

class DashboardController extends BaseAdminController
{
    private Renta $rentaModel;
    private Recommendation $recModel;

    public function __construct()
    {
        parent::__construct(); // Protege todo el controlador (Auth::requireAdmin)
        $this->rentaModel = new Renta();
        $this->recModel   = new Recommendation();
    }

    /**
     * Home del panel de administración
     * URL: /dashboard
     */
    public function index(): void
    {
        $currentUser         = $this->currentUser();
        $activeMenu          = 'dashboard';

        // Últimas rentas visibles + última recomendación (para el resumen)
        $rentas              = $this->rentaModel->getUltimasVisibles(2);
        $ultimaRecomendacion = $this->recModel->getUltima();

        $seo        = $this->buildSeo();
        $pageStyles = $this->getPageStyles();

        require __DIR__ . '/../views/admin/dashboardView.php';
    }

    // ----------------- Helpers privados -----------------

    private function buildSeo(): array
    {
        return [
            'title'       => 'Panel de administración | CuVaRents',
            'description' => 'Resumen de gestión de rentas y comentarios.',
            'keywords'    => 'admin, dashboard, cuvarents',
            'url'         => BASE_URL . 'dashboard',
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_CU',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Dashboard', BASE_URL . 'dashboard'],
            ],
            'pageType'    => 'admin-dashboard',
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
