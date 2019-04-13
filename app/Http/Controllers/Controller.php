<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * 替换校验失败抛出的异常
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     * @return void
     *
     * @throws \Exception
     */
    protected function throwValidationException(Request $request, $validator)
    {
        $msgs = $validator->messages()->toArray();

        array_walk($msgs, function($v, $k){
            throw new \Exception($v[0], 21000);
        });
    }

    //返回默认分页数量
    protected function defaultRerPage()
    {
        return env('KR_PER_PAGE', 10);
    }
}
