<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */
return [
    'enable' => true,
    'port' => 9500,
    'output_dir' => BASE_PATH . '/storage/swagger',
    'output_file' => 'swagger.json',
    'html' => null,
    'url' => '/swagger',
    'auto_generate' => true,
    'scan' => [
        'paths' => [
            BASE_PATH . '/app/Controller',
        ],
    ],
    'processors' => [
        // users can append their own processors here
    ],
    'swagger' => [
        'swagger' => '2.0',
        'info' => [
            'description' => 'API documentation',
            'version' => '1.0.0',
            'title' => 'My API',
        ],
        'host' => 'localhost:9501',
        'schemes' => ['http'],
        'paths' => [],
        'definitions' => [],
        'securityDefinitions' => [],
        'security' => [],
    ],
];
