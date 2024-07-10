<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Auth;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Response;
use Hyperf\HttpServer\Contract\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Psr7ResponseInterface;
class AuthService
{
    public RequestInterface $service;
    public function __construct($request)
    {
        $this->service = $request;
    }

    function create(): Psr7ResponseInterface
    {
        $response = new Response();
        try {
            //Salvando os dados
            Auth::create($this->service->all());
            return $response->json(['message' => 'success']);
        }catch (\Exception $e){
            return $response->json(['message' => $e->getMessage()]);
        }
    }
}
