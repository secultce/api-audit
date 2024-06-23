<?php

declare(strict_types=1);

namespace App\Service;

use App\Job\AuditAction as AuditActionJob;
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


    function create(): array
    {
        foreach ($this->service->all() as $keyRequestMethod => $valueRequestMethod) {

            if ($keyRequestMethod == "audit" && is_array($valueRequestMethod)) {


                try {
                    $serviceAudit =  AuditActionModel::create($valueRequestMethod);
                    $this->actionId = $serviceAudit->getAttribute("id");
                    $this->entityId = $serviceAudit->getAttribute("object_id");
//                    var_dump($serviceAudit);
                }catch (\Exception $e){
                    var_dump($e->getMessage());
                }

//                $idAction = AuditAction::create($valueRequestMethod);
//                $this->actionId = $idAction->getAttribute("id");
//                $this->entityId = $idAction->getAttribute("object_id");

            }
//            var_dump($this->actionId);
        }

        return [ 'entityId' => $this->entityId, 'actionId' => $this->actionId];
    }
}
