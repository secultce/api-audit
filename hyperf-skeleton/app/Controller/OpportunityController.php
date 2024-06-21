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
       $arrayEntityAuditData = [];
       $requestMethod = $request->all();

        foreach ($requestMethod as $keyRequestMethod => $valueRequestMethod) {
//            var_dump($keyRequestMethod);
            if($keyRequestMethod == "audit" && is_array($valueRequestMethod)) {
//                $idAction =  AuditAction::create($valueRequestMethod);
//                $actionId = $idAction->getAttribute("id");
                $actionId = 58;
            }

        }
        foreach ($requestMethod as $keyAction => $valueAction) {


            $entityAuditData = AuditData::where('audit_action_id', 1)->get();
            $arrayEntityAuditData = $entityAuditData->toArray();

        foreach ($arrayEntityAuditData as $keyarrayEntityAuditData => $valuearrayEntityAuditData) {

            if( ($valuearrayEntityAuditData["key"] == $keyAction) && ($valuearrayEntityAuditData["value"] !== $valueAction) )
            {
                var_dump($valueAction);
                die;
            }
        }


        }
//

    }

    public function getIdAction($id)
    {
        var_dump($id);
    }
}
