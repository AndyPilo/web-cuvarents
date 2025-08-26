<?php
// archivo: 404.php (puedes guardarlo aparte y luego incluirlo en send404())

function showCustom404()
{
    http_response_code(404);
    header("HTTP/1.1 404 Not Found");
    header("Status: 404 Not Found");
?>

    <!DOCTYPE html>
    <html lang="es">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>404 - Página no encontrada</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
        <style>
            body {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                background-color: #f8f9fa;
            }

            .error-container {
                text-align: center;
            }

            .error-code {
                font-size: 8rem;
                font-weight: bold;
                color: #ffc107;
                /* Amarillo estilo warning */
            }

            .error-message {
                font-size: 1.5rem;
                margin-bottom: 20px;
            }
        </style>
    </head>

    <body>
        <div class="error-container">
            <div class="error-code">404</div>
            <div class="error-message">Ups, la página que buscas no existe</div>
            <a href="/" class="btn btn-primary">Volver al inicio</a>
            <a href="/rents" class="btn btn-outline-secondary">Ver propiedades en alquiler</a>
        </div>
    </body>

    </html>

<?php
    exit();
}
