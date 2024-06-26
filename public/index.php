<?php

/**
 * Slim es un micro framework PHP que lo ayuda a escribir rápidamente aplicaciones web y API simples pero potentes.
 * En esencia, Slim es un despachador que recibe una solicitud HTTP,
 * invoca una rutina de devolución de llamada apropiada y devuelve una respuesta HTTP.
 */
require '../vendor/autoload.php';

// Instancia la aplicación ( Si la instancia se repite en las rutas, estas no funcionaran)
$settings = require __DIR__ . '/../src/settings.php';
$app = new \Slim\App($settings);

//Configurar dependencias
require __DIR__ . '/../src/dependencies.php';

//Registrar middleware
require __DIR__ . '/../src/middleware.php';

//Registrar rutas
require __DIR__ . '/../src/routes.php';

//Carga automaticamente lo que agreguemos dentro de las carpetas indicadas.
require __DIR__ . '/../app/ApplicationConfig.php';

//Le indicamos a Slim que hemos terminado la configuración y es hora de continuar con el evento principal.
/** @noinspection PhpUnhandledExceptionInspection */
$app->run();

