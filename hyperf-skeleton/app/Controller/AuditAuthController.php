<?php

declare(strict_types=1);

namespace App\Controller;


use App\Service\AuthService;
use Hyperf\Swagger\Annotation as SA;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;

#[SA\HyperfServer(name: 'http')]
class AuditAuthController
{

    //Realiza criação dos dados
    #[SA\Post(path: '/store', summary: 'Metodo post para registrar auth do usuario ao logar ou ao deslogar da plataforma mapa cultural', tags: ['user'])]
    #[SA\Parameter(
        name: 'request',
        description: 'Payload com todos os dados enviada do mapa cultural',
        in: 'path',
        required: true,
        schema: new SA\Schema(type: 'string')
    )]
    #[SA\Response(
        response: 200,
        description: 'Retornado com sucesso',
        content: new SA\JsonContent(
            example: '{"message":"success"}'
        )
    )]
    public function store(RequestInterface $request) : Psr7ResponseInterface
    {
        $auth = new AuthService($request);
        return $auth->create();
    }

}
