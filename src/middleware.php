<?php

/**
 * Puede ejecutar código antes y después de su aplicación Slim para manipular los objetos de
 * Solicitud y Respuesta como mejor le parezca. Esto se llama middleware.
 * NOTA: ¿Por qué querrías hacer esto?
 * Quizás desee proteger su aplicación de la falsificación de solicitudes entre sitios.
 * Tal vez desee autenticar las solicitudes antes de que se ejecute su aplicación.
 * El middleware es perfecto para estos escenarios.
 *
 */
use Slim\App;

return function (App $app) {
    // e.g: $app->add(new \Slim\Csrf\Guard);
};
