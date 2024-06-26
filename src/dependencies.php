<?php

/**
 * La mayoría de las aplicaciones tendrán algunas dependencias, y Slim las maneja muy bien usando un DIC
 * (Dependency Injection Container) integrado en Pimple .
 * La idea del contenedor de inyección de dependencias es que se configure el contenedor para poder cargar
 * las dependencias que su aplicación necesita, cuando las necesita. Una vez que el DIC se ha creado / ensamblado las dependencias,
 * las almacena y puede suministrarlas nuevamente más tarde si es necesario.
 * NOTA:
 * @noinspection PhpUndefinedMethodInspection Ignora la inspección en particular de un metodo magico
 */
use Slim\App;

return function (App $app) {
    $container = $app->getContainer();

    // RENDERER
    $container['renderer'] = function ($c) {
        /** @noinspection PhpUndefinedMethodInspection */
        $settings = $c->get('settings')['renderer'];
        return new \Slim\Views\PhpRenderer($settings['template_path']);
    };

    // MONOLOG
    $container['logger'] = function ($c) {
        /** @noinspection PhpUndefinedMethodInspection */
        $settings = $c->get('settings')['logger'];
        $logger = new \Monolog\Logger($settings['name']);
        $logger->pushProcessor(new \Monolog\Processor\UidProcessor());
        $logger->pushHandler(new \Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
        return $logger;
    };
};
