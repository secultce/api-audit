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

Router::addRoute('GET','/index/{name}', 'App\Controller\IndexController@index');

Router::addGroup('/opportunity', function (){
    Router::get('/{id}', 'App\Controller\OpportunityController@index');
    Router::post('/store', 'App\Controller\OpportunityController@store');
    Router::get('update', 'App\Controller\OpportunityController@update');
    Router::post('delete', 'App\Controller\OpportunityController@delete');
});


Router::get('/favicon.ico', function () {
    return '';
});

Router::post('create-user', [UserController::class, 'index'] );
