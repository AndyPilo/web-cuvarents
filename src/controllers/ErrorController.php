<?php
class ErrorController
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

        // Sanitizar valores null
        foreach ($merged as $key => $value) {
            if (!is_array($value)) {
                $merged[$key] = $value ?? '';
            }
        }

        return $merged;
    }

    public function error404(): void
    {
        http_response_code(404);

        $seo = $this->mergeSeoDefaults([
            'title' => 'Página no encontrada',
            'description' => 'Lo sentimos, la página que buscas no existe o fue movida. Explora más de 500 propiedades en Cuba con CuVaRents.',
            'keywords' => 'error 404, página no encontrada, alquiler en cuba, cuvarents',
            'url' => BASE_URL . '404',
            'robots' => 'noindex, follow',
            'breadcrumb' => [
                ['Inicio', BASE_URL],
                ['Error 404', BASE_URL . '404']
            ],
            'pageType' => 'error'
        ]);

        $pageStyles = ['assets/css/error.css'];

        require_once __DIR__ . '/../views/errors/404View.php';
    }

    public function error500(): void
    {
        http_response_code(500);

        $seo = $this->mergeSeoDefaults([
            'title' => 'Error interno del servidor',
            'description' => 'Ha ocurrido un error inesperado en nuestros servidores. Nuestro equipo técnico ya está trabajando para solucionarlo. Intenta nuevamente en unos minutos.',
            'keywords' => 'error 500, cuvarents, problema técnico, alquiler cuba',
            'url' => BASE_URL . '500',
            'robots' => 'noindex, follow',
            'breadcrumb' => [
                ['Inicio', BASE_URL],
                ['Error 500', BASE_URL . '500']
            ],
            'pageType' => 'error'
        ]);

        $pageStyles = ['assets/css/error.css'];

        require_once __DIR__ . '/../views/errors/500View.php';
    }
}
