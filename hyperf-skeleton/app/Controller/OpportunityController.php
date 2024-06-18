<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
class OpportunityController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        foreach($request->all() as $key => $value) {
            var_dump($key);
        }
//       return $request->all();
    }
}
