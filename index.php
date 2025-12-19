<?php
// index.php - Front controller

require_once __DIR__ . '/config/config.php';

spl_autoload_register(function (string $className): void {
    $paths = [
        __DIR__ . '/src/controllers/',
        __DIR__ . '/src/models/',
        __DIR__ . '/src/core/',
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Bootstrap: configuración de errores + sesión centralizada
require_once __DIR__ . '/src/core/bootstrap.php';

/* ============================================================
   1) Normalizar URL proveniente de .htaccess
   ============================================================ */

$url = $_GET['url'] ?? '';
$url = trim($url, '/');

$urlParts = $url === '' ? [] : explode('/', $url);

$segment0 = $urlParts[0] ?? '';
$segment1 = $urlParts[1] ?? null;
$segment2 = $urlParts[2] ?? null;
$segment3 = $urlParts[3] ?? null;

$controllerName = ucfirst($segment0 ?: 'home') . 'Controller';
$method         = $segment1 ?: 'index';
$param          = $segment2;

/* ============================================================
   3) Rutas específicas de ADMIN (/dashboard/...)
   ============================================================ */

if ($segment0 === 'dashboard') {

    $adminSection = $segment1 ?? '';
    $adminAction  = $segment2 ?? 'index';
    $param        = $segment3;

    switch ($adminSection) {
        case '':
            $controllerName = 'DashboardController';
            $method         = 'index';
            $param          = null;
            break;

        case 'rents':
            $controllerName = 'AdminRentsController';
            $method         = $adminAction;
            break;

        case 'single':
            $controllerName = 'AdminRentsController';
            $method         = 'show';
            $param          = $segment2; // id
            break;

        case 'reviews':
            $controllerName = 'AdminReviewsController';
            $method         = $adminAction;
            break;

        case 'reservas':
            $controllerName = 'AdminBookingController';
            $method         = $adminAction;
            break;

        case 'services':
            $controllerName = 'AdminServicesController';
            $method         = $adminAction;
            break;

        case 'profile':
            $controllerName = 'AdminProfileController';
            $method         = $adminAction;
            break;

        default:
            $controllerName = 'ErrorController';
            $method         = 'error404';
            $param          = null;
            break;
    }
} else {

    // 1) Detalle: /rents/{id} o /rents/{slug}-{id}
    if (preg_match('#^rents/([a-z0-9-]+-)?(\d+)$#i', $url, $matches)) {
        $controllerName = 'RentasController';
        $method         = 'show';
        $param          = $matches[2]; // id numérico
    }

    // 2) Provincias con paginación: /rents/provincias/{slug}/page/{n}
    elseif (preg_match('#^rents/provincias/([a-z0-9-]+)/page/(\d+)$#i', $url, $matches)) {
        $_GET['provincia_slug'] = $matches[1];
        $_GET['page']           = $matches[2];
        $controllerName         = 'RentasController';
        $method                 = 'index';
        $param                  = null;
    }

    // 3) Provincias: /rents/provincias/{slug}
    elseif (preg_match('#^rents/provincias/([a-z0-9-]+)$#i', $url, $matches)) {
        $_GET['provincia_slug'] = $matches[1];
        $controllerName         = 'RentasController';
        $method                 = 'index';
        $param                  = null;
    }

    // 4) Municipios con paginación: /rents/municipios/{slug}/page/{n}
    elseif (preg_match('#^rents/municipios/([a-z0-9-]+)/page/(\d+)$#i', $url, $matches)) {
        $_GET['municipio_slug'] = $matches[1];
        $_GET['page']           = $matches[2];
        $controllerName         = 'RentasController';
        $method                 = 'index';
        $param                  = null;
    }

    // 5) Municipios: /rents/municipios/{slug}
    elseif (preg_match('#^rents/municipios/([a-z0-9-]+)$#i', $url, $matches)) {
        $_GET['municipio_slug'] = $matches[1];
        $controllerName         = 'RentasController';
        $method                 = 'index';
        $param                  = null;
    }

    // 6) Paginación general: /rents/page/{n}
    elseif (preg_match('#^rents/page/(\d+)$#i', $url, $matches)) {
        $_GET['page']   = $matches[1];
        $controllerName = 'RentasController';
        $method         = 'index';
        $param          = null;
    }

    // 7) Categoría con paginación: /rents/{slug}/page/{n}
    elseif (preg_match('#^rents/([a-z0-9-]+)/page/(\d+)$#i', $url, $matches)) {
        $_GET['categoria'] = $matches[1]; // slug de categoría
        $_GET['page']      = $matches[2];
        $controllerName    = 'RentasController';
        $method            = 'index';
        $param             = null;
    }

    // 8) Categoría: /rents/{slug}
    elseif (preg_match('#^rents/([a-z0-9-]+)$#i', $url, $matches)) {
        $_GET['categoria'] = $matches[1]; // slug de categoría
        $controllerName    = 'RentasController';
        $method            = 'index';
        $param             = null;
    } else {
        $customRoutes = [
            ''            => ['controller' => 'HomeController',    'method' => 'index'],
            'home'        => ['controller' => 'HomeController',    'method' => 'index'],
            'rents'       => ['controller' => 'RentasController',  'method' => 'index'],
            'about'       => ['controller' => 'AboutController',   'method' => 'index'],
            'contact'     => ['controller' => 'ContactController', 'method' => 'index'],
            'login'       => ['controller' => 'AuthController',    'method' => 'login'],
            'register'    => ['controller' => 'AuthController',    'method' => 'register'],
            'logout'      => ['controller' => 'AuthController',    'method' => 'logout'],
            'sitemap.xml' => ['controller' => 'SitemapController', 'method' => 'index'],
        ];

        $routeKey = $segment0 ?? '';
        if (array_key_exists($routeKey, $customRoutes)) {
            $route          = $customRoutes[$routeKey];
            $controllerName = $route['controller'];
            $method         = $route['method'];
            $param          = null;
        }
    }
}

if (class_exists($controllerName)) {
    $controller = new $controllerName();

    if (method_exists($controller, $method)) {
        $param !== null
            ? $controller->$method($param)
            : $controller->$method();
    } else {
        http_response_code(404);
        if (class_exists('ErrorController')) {
            (new ErrorController())->error404();
        } else {
            echo "<h1>Error 404</h1><p>Método '" . htmlspecialchars($method, ENT_QUOTES, 'UTF-8') . "' no encontrado en {$controllerName}</p>";
        }
    }
} else {
    http_response_code(404);
    if (class_exists('ErrorController')) {
        (new ErrorController())->error404();
    } else {
        echo "<h1>Error 404</h1><p>Controlador '{$controllerName}' no encontrado</p>";
    }
}
