<?php namespace App\Traits;

use KrLog;
use KrHttp;

trait Request
{

    /**
     * 获取请求参数
     *
     * @return void
     */
    public function getParams($rules = [], $has_per_page = false, $err_messages = null)
    {
        $messages = [
            'required' => ':attribute字段为必填',
            'numeric' => ':attribute字段必须为数字',
            'between' => ':attribute字段必须在:min - :max之间',
            'in' => ':attribute字段必须是以下值:values',
            'array' => ':attribute字段必须为数组',
        ];

        if (!empty($err_messages)) {
            $messages = array_merge($messages, $err_messages);
        }

        $keys = array_keys($rules);

        // 过滤掉 array.*.id 这类的规则，因为他们不是具体的一维字段
        $keys = array_filter($keys, function($val){
            return strpos($val, '*') === false;
        });

        $params = $keys ? \Request::only($keys) : \Request::all();

        // dd($params);

        $validator = \Validator::make($params, $rules, $messages);

        if ($validator->fails()) {
            $msgs = $validator->messages()->toArray();

            array_walk($msgs, function($v, $k){
                throw new \Exception($v[0], 21000);
            });
        }

        foreach ($params as $k => $v) {
            if ($v === null) {
                unset($params[$k]);
            } elseif (is_string($params[$k])) {
                $params[$k] = trim($params[$k]);
            }
        }

        if ($has_per_page) {
            $params['per_page'] = \Request::get('per_page') ? \Request::get('per_page') : env('KR_PER_PAGE');
        }

        return $params;
    }
}
