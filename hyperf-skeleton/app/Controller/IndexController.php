<?php

declare(strict_types=1);
/**
 * This file is part of Hyperf.
 *
 * @link     https://www.hyperf.io
 * @document https://hyperf.wiki
 * @contact  group@hyperf.io
 * @license  https://github.com/hyperf/hyperf/blob/master/LICENSE
 */

namespace App\Controller;

use Hyperf\DbConnection\Db;
use Hyperf\Collection\Arr;

class IndexController extends AbstractController
{
    public function index()
    {
        Db::enableQueryLog();
        var_dump(Arr::last(Db::getQueryLog()));
//        die;
//        $user = $this->request->input('user', 'Hyperf');
//        $method = $this->request->getMethod();

        $users = Db::select('SELECT * FROM audit_action;'); // return array
        return $users;
    }
}
