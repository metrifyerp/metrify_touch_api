<?php

use Monolog\Logger;

return [
    'settings' => [
        'displayErrorDetails' => true,     //TODO: En producción, cambiar a: False --> Deshabilitar en producción
        'addContentLengthHeader' => false, //Permitir que el servidor web envíe en el encabezado la longitud de contenido
        'docs' => __DIR__ . '/../public/docs', // Directorio donde se subiran los documentos
        //Configuraciones de renderizador
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],
        //Configuraciones de Monolog
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => Logger::DEBUG,
        ],
    ],
];
