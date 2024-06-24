<?php

declare(strict_types=1);

namespace App\Service;

use Hyperf\HttpServer\Response;
use Hyperf\HttpServer\Contract\RequestInterface;
use App\Model\AuditAction as AuditActionModel;

class AuditData
{
    public int $actionId;
    public string $entityId;

    public  $service;
    public function __construct(RequestInterface $request)
    {
       $this->service = $request;
    }

    function create(): array|Response
    {
        foreach ($this->service->all() as $keyRequestMethod => $valueRequestMethod) {

            if ($keyRequestMethod == "audit" && is_array($valueRequestMethod)) {
                try {
                    $serviceAudit =  AuditActionModel::create($valueRequestMethod);
                    $this->actionId = $serviceAudit->getAttribute("id");
                    $this->entityId = $serviceAudit->getAttribute("object_id");
                }catch (\Exception $e){
                    $response = new Response();
                    return $response->json(['message' => $e->getMessage()]);
                }
            }
        }

        return [ 'entityId' => $this->entityId, 'actionId' => $this->actionId];
    }
}
