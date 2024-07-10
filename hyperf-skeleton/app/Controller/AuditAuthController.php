<?php

declare(strict_types=1);

namespace App\Controller;


use App\Service\AuthService;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

class AuditAuthController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $req = $request->all();
        return $req;
    }

    //Realiza criação dos dados
    public function store(RequestInterface $request) : Psr7ResponseInterface
    {
        $auth = new AuthService($request);
        return $auth->create();
    }
}
