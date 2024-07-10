<?php

declare(strict_types=1);

namespace App\Test\Unit;

use _PHPStan_01e5828ef\Nette\Utils\DateTime;
use App\Model\Auth as ModelAuth;
use App\Controller\AuditAuthController;
use Hyperf\Database\Model\Collection;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use Hyperf\Guzzle\CoroutineHandler;
use GuzzleHttp\HandlerStack;

class AuthTest extends TestCase
{
    public function testStore()
    {
        $dt = new DateTime();
        //Itens para requisição
        $requestAudit = [
            'ip_remote'     => '172.18.3.101',
            'addr_host'     => '172.18.3.44:80',
            'referer'       => '/autenticacao/fakeLogin/Faker',
            'resource_uri'  => '',
            'userAgent'     =>'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/126.0.0.0 Safari/537.36',
            'createTime'    => $dt->format('Y-m-d H:i:s'),
            'userLogin'     => 30490,
            'action'        => 'Logou do sistema'
        ];
        //configuração do Guzzle
        $client = new Client([
            'base_uri' => 'http://172.18.3.44:9501/',
            'handler' => HandlerStack::create(new CoroutineHandler()),
            'timeout'  => 2.0,
            'swoole' => [
                'timeout' => 10,
                'socket_buffer_size' => 1024 * 1024 * 2,
            ],
        ]);
        //enviando para a rota
        $response = $client->request('POST', 'user/store',
        [
            'headers' => [
                'Content-Type' => 'application/x-www-form-urlencoded'
            ],
            'form_params' => $requestAudit
        ]);
        $this->assertEquals(200, $response->getStatusCode());
    }

}