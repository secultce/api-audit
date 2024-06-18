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

use App\Controller\UserController;
use App\Controller\OpportunityController;
use Hyperf\HttpServer\Router\Router;

Router::addRoute(['GET', 'POST', 'HEAD'], '/', 'App\Controller\IndexController@index');

Router::post('/data-opportunity', 'App\Controller\OpportunityController@index');

Router::get('/favicon.ico', function () {
    return '';
});

Router::post('create-user', [UserController::class, 'index'] );
