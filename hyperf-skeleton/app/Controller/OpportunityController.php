<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\AuditAction;
use App\Model\AuditData;
class OpportunityController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {

       foreach ($request->all() as $key => $value) {
//           var_dump(gettype($key));

           if($key == "audit" && is_array($value)) {

              $idAction =  AuditAction::create($value);
              $actionId = (int) $idAction->getAttribute("id");

           }

           var_dump($actionId);
           if($key != "audit") {

//               var_dump(gettype($actionId));
//               var_dump($actionId);
//               var_dump($actionId > 0);
               if($actionId)
               {
                   var_dump('Acessou o IF');
               }
//              $data = ["key" => $key, "value" => $value, "audit_action_id" => $actionId];
//               AuditData::create($data);
           }
       }


//        var_dump($response);
//        $audit  = new AuditAction();
//        $audit->user_id = $request->user_id;
//        $audit->type = $request->type;
//        $audit->action = $request->action;
//        $audit->message = $request->message;
////        foreach($request->all() as $key => $value) {
////            var_dump($key);
////            $audit->$key = $value;
////        }
//       $audit->save();
//       return $request->all();
//        Db::table('audit_action')->insert($request->all());
//           return AuditAction::create($request->all());
    }

    public function getIdAction($id)
    {
        var_dump($id);
    }
}
