<?php
require_once __DIR__ . '/../models/Renta.php';
require_once __DIR__ . '/../../utils/slugify.php';

class SitemapController
{

    private Renta $rentaModel;

    public function __construct()
    {
        $this->rentaModel = new Renta();
    }

    public function index(): void
    {
        header('Content-Type: application/xml; charset=utf-8');
        $this->rentaModel->getAllForSitemap();

        echo '<?xml version="1.0" encoding="UTF-8"?>';
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

        // Páginas estáticas
        $staticUrls = [
            ['https://cuvarents.com/', '1.0'],
            ['https://cuvarents.com/rents', '1.0'],
            ['https://cuvarents.com/about', '0.8'],
            ['https://cuvarents.com/contact', '0.8'],
        ];

        foreach ($staticUrls as [$loc, $priority]) {
            echo "<url><loc>{$loc}</loc><priority>{$priority}</priority></url>";
        }

        // Categorías
        $categories = [
            'casas-de-lujo',
            'casas-en-la-playa',
            'casas-y-apartamentos-por-largas-y-cortas-estancias',
            'casas-y-alojamientos-vacacionales'
        ];

        foreach ($categories as $slug) {
            echo "<url><loc>https://cuvarents.com/rents/{$slug}</loc><priority>0.9</priority></url>";
        }

        // Rentas individuales
        foreach ($rentas as $r) {
            $slug = slugify($r['rental_title']);
            $id = $r['rental_id'];
            $url = "https://cuvarents.com/rents/{$slug}-{$id}";
            echo "<url><loc>{$url}</loc><priority>0.8</priority></url>";
        }

        echo '</urlset>';
    }
}
