<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\AuditAction;
use App\Service\AuditData as ServiceAuditData;
use App\Model\AuditData;
use Hyperf\DbConnection\Db;

class OpportunityController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
        $requestMethod = $request->all();
        /*  Refatorar para adicionar chave e valor em caso de haver alteração na requisição
            comparado ao que está no banco
         *
        $entityAuditData = AuditData::where('object_id',$requestMethod["audit"]["object_id"])->get();
        $arrayEntityAuditData = $entityAuditData->toArray();
        if(count($arrayEntityAuditData) == 0) {
            $jobAuditAction = new ServiceAuditData($request);
            $entity = $jobAuditAction->create();

            foreach ($requestMethod as $keyAction => $valueAction) {
                $auditData = [
                    'key' => $keyAction,
                    'value' => $valueAction,
                    'object_id' => $entity['entityId'],
                    'audit_action_id' => $entity['actionId']
                ];
                AuditData::create($auditData);
            }
        }
         */
        $jobAuditAction = new ServiceAuditData($request);
        $entity = $jobAuditAction->create();
        try {
            foreach ($requestMethod as $keyAction => $valueAction) {
                $auditData = [
                    'key' => $keyAction,
                    'value' => $valueAction,
                    'object_id' => $entity['entityId'],
                    'audit_action_id' => $entity['actionId']
                ];
                AuditData::create($auditData);
            }
            return $response->json(['message' => 'success']);
        }catch (\Exception $exception){
            return $response->json(['message' => $exception->getMessage()]);
        }
    }

}
