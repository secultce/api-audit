<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\AuditAction;
use App\Service\AuditData as ServiceAuditData;
use App\Model\AuditData;
use OpenApi\Annotations as OA;


/**
 * @OA\Info(title="Minha API", version="1.0.0")
 */

/**
 * @OA\Get(
 *     path="/opportunity",
 *     @OA\Response(response="200", description="Lista de registros")
 * )
 */
class OpportunityController extends AbstractController
{
    public function index(string $id)
    {
        $auditActionAndData = AuditAction::join('audit_data', 'audit_action.id', '=', 'audit_data.audit_action_id')
            ->where('audit_data.object_id', $id)
            ->where('audit_action.object_id', $id)->get();
        $resultArray = [];
        $tempArray = [];

        foreach ($auditActionAndData as $item) {
            $identifier = $item['user_id'] . $item['type'] . $item['object_id'] . $item['action'] . $item['message'] . $item['created_at'] . $item['updated_at'];

            if (!isset($tempArray[$identifier])) {
                $tempArray[$identifier] = [
                    "user_id" => $item['user_id'],
                    "type" => $item['type'],
                    "object_id" => $item['object_id'],
                    "action" => $item['action'],
                    "message" => $item['message'],
                    "created_at" => $item['created_at'],
                    "updated_at" => $item['updated_at'],
                    "data" => []
                ];
            }

            $tempArray[$identifier]['data'][] = [
                "key" => $item['key'],
                "value" => $item['value'],
                "audit_action_id" => $item['audit_action_id']
            ];
        }

        $resultArray = array_values($tempArray);
        return json_encode($resultArray, JSON_PRETTY_PRINT);
    }
    public function store(RequestInterface $request, ResponseInterface $response)
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
