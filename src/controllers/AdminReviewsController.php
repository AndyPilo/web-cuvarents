<?php
// src/controllers/AdminReviewsController.php
declare(strict_types=1);

require_once __DIR__ . '/../models/Recommendation.php';

class AdminReviewsController extends BaseAdminController
{
    private Recommendation $recModel;

    public function __construct()
    {
        parent::__construct();
        $this->recModel = new Recommendation();
    }

    /**
     * Listado y gestión de reseñas
     * URL: /dashboard/reviews
     */
    public function index(): void
    {
        $currentUser     = $this->currentUser();
        $activeMenu      = 'reviews';

        // Todas las recomendaciones, ordenadas de más nueva a más antigua
        $recommendations = $this->recModel->getAll();

        $seo        = $this->buildSeo();
        $pageStyles = $this->getPageStyles();

        require __DIR__ . '/../views/admin/reviewsView.php';
    }

    /**
     * Crear una nueva reseña
     * URL: POST /dashboard/reviews/store
     */
    public function store(): void
    {
        $this->ensurePost();

        $reviewText = trim($_POST['reviewText'] ?? '');
        $userName   = trim($_POST['userName']   ?? '');
        $userRank   = trim($_POST['userRank']   ?? '');

        if ($reviewText === '' || $userName === '' || $userRank === '') {
            Session::flash('error', 'Todos los campos son obligatorios.');
            header('Location: ' . BASE_URL . 'dashboard/reviews');
            exit;
        }

        $ok = $this->recModel->create([
            'user_name'          => $userName,
            'user_rank'          => $userRank,
            'recommendation_text' => $reviewText,
        ]);

        Session::flash(
            $ok ? 'success' : 'error',
            $ok ? 'Reseña creada correctamente.' : 'No se pudo crear la reseña.'
        );

        header('Location: ' . BASE_URL . 'dashboard/reviews');
        exit;
    }

    /**
     * Eliminar reseña
     * URL: POST /dashboard/reviews/delete
     */
    public function delete(): void
    {
        $this->ensurePost();

        $id = isset($_POST['id']) ? (int)$_POST['id'] : 0;

        if ($id <= 0) {
            Session::flash('error', 'ID de reseña inválido.');
            header('Location: ' . BASE_URL . 'dashboard/reviews');
            exit;
        }

        $ok = $this->recModel->delete($id);

        if ($ok) {
            Session::flash('success', 'Reseña eliminada correctamente.');
        } else {
            // 🔹 Caso equivalente al "Comentario no encontrado" del Proyecto A
            Session::flash('error', 'No se pudo eliminar la reseña (no encontrada o ya eliminada).');
        }

        header('Location: ' . BASE_URL . 'dashboard/reviews');
        exit;
    }

    // ------------- Helpers privados -------------

    private function ensurePost(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . 'dashboard/reviews');
            exit;
        }
    }

    private function buildSeo(): array
    {
        return [
            'title'       => 'Reseñas | Panel CuVaRents',
            'description' => 'Gestión de reseñas / recomendaciones mostradas en el sitio.',
            'keywords'    => 'admin, reviews, recomendaciones, cuvarents',
            'url'         => BASE_URL . 'dashboard/reviews',
            'image'       => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type'        => 'website',
            'locale'      => 'es_CU',
            'robots'      => 'noindex, nofollow',
            'breadcrumb'  => [
                ['Inicio', BASE_URL],
                ['Dashboard', BASE_URL . 'dashboard'],
                ['Reseñas', BASE_URL . 'dashboard/reviews'],
            ],
            'pageType'    => 'admin-reviews',
        ];
    }

    private function getPageStyles(): array
    {
        // Reutilizamos el mismo set que en otras vistas de admin,
        // o lo ajustas si aquí necesitas menos.
        return [
            'assets/css/choices.min.css',
            'assets/css/nouislider.min.css',
            'assets/css/swiper-bundle.min.css',
            'assets/css/file-upload.css',
        ];
    }
}
