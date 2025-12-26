<?php
require_once __DIR__ . '/../models/Renta.php';

class HomeController
{
    private Renta $rentaModel;

    public function __construct()
    {
        $this->rentaModel = new Renta();
    }

    private function mergeSeoDefaults(array $customSeo = []): array
    {
        $defaults = [
            'title' => 'CuvaRents | Casas particulares de alquiler en Cuba',
            'description' => 'Casas particulares, apartamentos, hostales y villas en alquiler en toda Cuba. Reserva por WhatsApp.',
            'url' => BASE_URL,
            'image' => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type' => 'website',
            'locale' => 'es_CU',
            'robots' => 'index, follow',
            'breadcrumb' => [['Inicio', BASE_URL]],
            'pageType' => 'general'
        ];

        $merged = array_merge($defaults, $customSeo);

        // Sanitizar valores null
        foreach ($merged as $key => $value) {
            if (!is_array($value)) {
                $merged[$key] = $value ?? '';
            }
        }

        return $merged;
    }

    public function index(): void
    {
        $categories = [
            "Casas de lujo",
            "Casas en la playa",
            "Casas y Apartamentos por largas y cortas estancias",
            "Casas y Alojamientos vacacionales"
        ];

        $seo = $this->mergeSeoDefaults([
            'title' => 'Casas particulares de alquiler en Cuba | CuVaRents',
            'description' => 'Casas particulares, apartamentos, hostales y villas de alquiler en toda Cuba. Propiedades en La Habana, Varadero, Trinidad y más. Reserva por WhatsApp.',
            'url' => BASE_URL,
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'breadcrumb' => [['Inicio', BASE_URL]],
            'pageType' => 'home'
        ]);

        $rentasPorCategoria = [];
        foreach ($categories as $cat) {
            $rentasPorCategoria[$cat] = $this->rentaModel->getByCategory($cat, 8);
        }

        require_once __DIR__ . '/../views/home/homeView.php';
    }
}
