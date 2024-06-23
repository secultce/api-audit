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

use Hyperf\Database\Connectors\ConnectionFactory;
use Hyperf\Database\ConnectionResolver;
use Hyperf\Database\Model\Model;


return [
    Hyperf\HttpServer\CoreMiddleware::class => App\Middleware\CoreMiddleware::class,
    ConnectionResolver::class => function () {
        $factory = new ConnectionFactory();
        $connection = $factory->make(config('databases.default'));
        $resolver = new ConnectionResolver(['default' => $connection]);
        $resolver->setDefaultConnection('default');
        Model::setConnectionResolver($resolver);
        return $resolver;
    },
];
