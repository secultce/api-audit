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
        $actionId = 0;
        $entityId = 0;
        $arrayEntityAuditData = [];
        $requestMethod = $request->all();

//        $jobAuditAction = new ServiceAuditData();
//        var_dump($requestMethod); die;
//        $ret = $jobAuditAction->create($request);
//        var_dump($ret);
//        die;

        $entityAuditData = AuditData::where('object_id',$entityId)->get();
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


//        foreach ($requestMethod as $keyAction => $valueAction) {
//
//
//            $entityAuditData = AuditData::where('object_id',$entityId)->get();
//            $arrayEntityAuditData = $entityAuditData->toArray();
//
//            $auditData = [
//                'key' => $keyAction,
//                'value' => $valueAction,
//                'object_id' => $entityId,
//                'audit_action_id' => $actionId
//            ];
////            print_r($auditData);
////            die;
////            var_dump(gettype($auditData));
////            AuditData::create($auditData);
//            if(count($arrayEntityAuditData) > 0){
//                foreach ($arrayEntityAuditData as $keyarrayEntityAuditData => $valuearrayEntityAuditData) {
//
//                    if( ($valuearrayEntityAuditData["key"] == $keyAction) && ($valuearrayEntityAuditData["value"] !== $valueAction) )
//                    {
////                    var_dump($valueAction);
////                    var_dump($auditData);die;
//                        $jobAuditAction = new ServiceAuditData($requestMethod);
//                        var_dump($jobAuditAction);
//                    }
//                }
//            }else{
////                $jobAuditAction = new ServiceAuditData($requestMethod);
////                $jobAuditAction->create();
////                var_dump($jobAuditAction);
//            }



//
//        }
//
//    return true;
    }

    public function getIdAction($id)
    {
        var_dump($id);
    }
}
