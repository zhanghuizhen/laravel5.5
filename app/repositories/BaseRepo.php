<?php
/**
 * Created by PhpStorm.
 * User: pc
 * Date: 2019/3/21
 * Time: 22:37
 */

namespace App\repositories;


class BaseRepo
{
    //返回默认分页数量
    protected function defaultRerPage()
    {
        return env('KR_PER_PAGE', 10);
    }
}