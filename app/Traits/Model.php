<?php
/**
 * Created by PhpStorm.
 * User: bjqxdn0529
 * Date: 2019/1/8
 * Time: 18:22
 */

namespace App\Traits;


trait Model
{

    /**
     * 获取Handles
     *
     * @return void
     */
    public function getSearchHandles($operators = [])
    {
        $handles = [];

        foreach ($operators as $k => $v) {
            if (in_array($v, ['=', '<>', '>', '<', '>=', '<='])) {
                $handles[$k] = function($query, $value) use ($k, $v){
                    $table = $query->getModel()->table;
                    $query->where($table . '.' . $k, $v, $value);
                };
            } elseif (in_array($v, ['like', 'not like'])) {
                $handles[$k] = function($query, $value) use ($k, $v){
                    $table = $query->getModel()->table;
                    $query->where($table . '.' . $k, $v, '%' . $value . '%');
                };
            } elseif ($v == 'in') {
                $handles[$k] = function($query, $value) use ($k, $v){
                    $table = $query->getModel()->table;
                    $query->whereIn($table . '.' . $k, explode(',', $value));
                };
            } elseif ($v == 'not in') {
                $handles[$k] = function($query, $value) use ($k, $v){
                    $table = $query->getModel()->table;
                    $query->whereNotIn($table . '.' . $k, $value);
                };
            } elseif (is_callable($v)) {
                $handles[$k] = $v;
            }
        }

        return $handles;
    }

    /**
     * 获取query
     */
    public function getQuery()
    {
        return self::query();
    }

    /**
     * 查询
     */
    public function search($params, $handles = [])
    {
        $query = $this->getQuery();

        if(empty($handles)){
            return $query;
        }

        foreach ($params as $key => $value) {
            if(empty($value) && $value !== '0'){
                if(isset($handles["__{$key}__"])){
                    $handles["__{$key}__"]($query,$value);
                }else{
                    continue;
                }
            }elseif(is_callable($handles[$key])){
                $handles[$key]($query,$value);
            }
        }
        return $query;
    }

}
