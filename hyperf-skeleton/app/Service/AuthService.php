<?php

declare(strict_types=1);

namespace App\Service;

use App\Model\Auth;
use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Response;
use function Hyperf\Support\env;
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
        $res = $this->service->all();
        //Verificando o endereço do host
        if(env('ADDR_HOST') == $res['addr_host'])
        {
            try {
                //Salvando os dados
                $validate = $this->verfifyRequest();
                if ($validate) {
                    Auth::create($res);
                }
                return $response->json(['message' => 'success']);
            }catch (\Exception $e){
                return $response->json(['message' => $e->getMessage()]);
            }
        };
        return $response->json(['data' =>  'Requisição de outro domínio'])->withStatus(403);
    }

    private function verfifyRequest() : bool
    {
        $res = $this->service->all();
        foreach ($res as $key => $value) {
            if ($key !== 'referer' && (is_null($value) || $value === '')) {
                return false;
            }
        }
        return true;
    }


}
