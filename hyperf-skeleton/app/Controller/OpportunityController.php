<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\AuditAction;
use App\Service\AuditData as ServiceAuditData;
use App\Model\AuditData;
use Hyperf\Swagger\Annotation as SA;
use OpenApi\Annotations as OA;

#[SA\HyperfServer(name: 'http')]
class OpportunityController extends AbstractController
{
    #[SA\Get('/opportunity', summary: 'Retorna dados de uma oportuniade', tags: ['opportunity'])]
    #[SA\QueryParameter(name: 'id', description: 'Id da Oportunidade')]
//    #[SA\RequestBody(content: new SA\JsonContent(properties: [
//        new SA\Property(property: 'nickname', type: 'integer', rules: 'required|string'),
//        new SA\Property(property: 'gender', type: 'integer', rules: 'required|integer|in:0,1,2'),
//    ]))]
    #[SA\Response(response: '200', content: new SA\JsonContent(ref: '#/components/schemas/SavedSchema'))]
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
        //Consutando a oportunidade no banco de dados
        $entityAuditData = AuditData::where('object_id',$requestMethod["audit"]["object_id"])->get();
        $arrayEntityAuditData = $entityAuditData->toArray();
        //Gravando a ação
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
        return $response->json(['message' => 'success']);
        //Se não tiver nada no banco, realiza a gravação dos dados
//        if(count($arrayEntityAuditData) == 0) {
//            foreach ($requestMethod as $keyAction => $valueAction) {
//                $auditData = [
//                    'key' => $keyAction,
//                    'value' => $valueAction,
//                    'object_id' => $entity['entityId'],
//                    'audit_action_id' => $entity['actionId']
//                ];
//                AuditData::create($auditData);
//            }
//            return $response->json(['message' => 'success']);
//        }else{
//            //Se tiver registro no banco de dados, salva somente o que está diferente
//            foreach ($arrayEntityAuditData as $valueEntity) {
//                //Verificando se a chave e o valor que está no banco se é igual aos dados da requisição
//                if (
//                    array_key_exists($valueEntity["key"], $requestMethod)
//                    !==
//                    in_array($valueEntity["value"], $requestMethod)
//                ) {
//                    $auditData = [
//                        'key' => $valueEntity["key"],
//                        'value' => $valueEntity["value"],
//                        'object_id' => $entity['entityId'],
//                        'audit_action_id' => $entity['actionId']
//                    ];
//                    AuditData::create($auditData);
//                }
//            }
//            return $response->json(['message' => 'success']);
//        }

    }

}
