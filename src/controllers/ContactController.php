<?php
class ContactController
{
    private function mergeSeoDefaults(array $customSeo = []): array
    {
        $defaults = [
            'title' => 'CuVaRents | Alquiler de Casas en Cuba',
            'description' => 'Encuentra casas particulares y apartamentos en alquiler en toda Cuba. +500 propiedades verificadas. Reserva segura con CuVaRents.',
            'keywords' => 'alquiler casas cuba, rentas cuba, casas particulares, apartamentos cuba, cuvarents',
            'url' => BASE_URL,
            'image' => BASE_URL . 'assets/img/og-image-cuvarents.jpg',
            'type' => 'website',
            'locale' => 'es_ES',
            'robots' => 'index, follow',
            'breadcrumb' => [['Inicio', BASE_URL]],
            'pageType' => 'general'
        ];

        $merged = array_merge($defaults, $customSeo);

        foreach ($merged as $key => $value) {
            if (!is_array($value)) {
                $merged[$key] = $value ?? '';
            }
        }

        return $merged;
    }

    public function index(): void
    {
        $seo = $this->mergeSeoDefaults([
            'title' => 'Contacto',
            'description' => 'CuVaRents ofrece una amplia selección de propiedades en alquiler en toda Cuba. Encuentra tu hogar ideal en La Habana, Santiago de Cuba, Matanzas y más.',
            'keywords' => 'contacto cuvarents, rentas en Cuba, alquileres en Cuba, apartamentos en Cuba, casas en Cuba, CuVaRents, Uixsoftware, alquiler de viviendas, La Habana, Santiago de Cuba, Matanzas, provincia, municipio, Cuba',
            'url' => BASE_URL . 'contact',
            'robots' => 'index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1',
            'image' => BASE_URL . 'assets/img/logos/logo_qvarents.svg',
            'breadcrumb' => [
                ['Inicio', BASE_URL],
                ['Contacto', BASE_URL . 'contact']
            ],
            'pageType' => 'contact'
        ]);

        $pageStyles = ['assets/css/contact.css'];

        require_once __DIR__ . '/../views/contactView.php';
    }
}
