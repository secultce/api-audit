<?php

declare(strict_types=1);

namespace App\Controller;

use Hyperf\HttpServer\Contract\RequestInterface;
use Hyperf\HttpServer\Contract\ResponseInterface;
use App\Model\AuditAction;
use Hyperf\DbConnection\Db;
class OpportunityController extends AbstractController
{
    public function index(RequestInterface $request, ResponseInterface $response)
    {
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
           return AuditAction::create($request->all());
    }
}
