<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\AuditAction;
use App\Model\AuditData;
use Hyperf\DbConnection\Db;
class OpportunityController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
       $actionId = 0;
        $entityId = 0;
       $arrayEntityAuditData = [];
       $requestMethod = $request->all();

        foreach ($requestMethod as $keyRequestMethod => $valueRequestMethod) {
//            var_dump($keyRequestMethod);
            if($keyRequestMethod == "audit" && is_array($valueRequestMethod)) {

                $idAction =  AuditAction::create($valueRequestMethod);
                $actionId = $idAction->getAttribute("id");
                $entityId = $idAction->getAttribute("object_id");

            }

        }

        foreach ($requestMethod as $keyAction => $valueAction) {


            $entityAuditData = AuditData::where('object_id',$entityId)->get();
            $arrayEntityAuditData = $entityAuditData->toArray();

            $auditData = [
                'key' => $keyAction,
                'value' => $valueAction,
                'object_id' => $entityId,
                'audit_action_id' => $actionId
            ];
//            print_r($auditData);
//            die;
//            var_dump(gettype($auditData));
//            AuditData::create($auditData);
            if(count($arrayEntityAuditData) > 0){
                foreach ($arrayEntityAuditData as $keyarrayEntityAuditData => $valuearrayEntityAuditData) {

                    if( ($valuearrayEntityAuditData["key"] == $keyAction) && ($valuearrayEntityAuditData["value"] !== $valueAction) )
                    {
//                    var_dump($valueAction);
//                    var_dump($auditData);die;
                        AuditData::create($auditData);
                    }
                }
            }
            if($keyAction !== "audit") {

    //            var_dump($auditData);die;
//                var_dump($auditData);
                AuditData::create($auditData);

            }



        }

    return true;
    }

    public function getIdAction($id)
    {
        var_dump($id);
    }
}
