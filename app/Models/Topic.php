<?php

namespace App\Models;

class Topic extends BaseModel
{
    protected $table = 'topics';

    public $timestamps = true;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];

    /**
     * 关联用户表
     *
     * @return void
     */
    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

}
