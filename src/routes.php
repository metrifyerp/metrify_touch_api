<?php

/**
 * El enrutador del Slim Framework está construido sobre el componente nikic / fastroute,
 * y es notablemente rápido y estable.
 *
 * NOTA:
 * @noinspection PhpUnusedParameterInspection Ignora la inspección en particular de un param no usado

 */
use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/[{name}]', function (/** @noinspection PhpUnusedParameterInspection */
        Request $request, Response $response, array $args) use ($container) {
        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);
    });
};
