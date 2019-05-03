<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = 'addresses';

    public $timestamps = true;

    protected $guarded = [];

    protected $dates = ['created_at', 'updated_at'];
}
