<?php
/**
 * Created by PhpStorm.
 * User: bjqxdn0529
 * Date: 2019/1/8
 * Time: 15:26
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Request;


abstract class BaseModel extends Model {

    use \App\Traits\Request;
    use \App\Traits\Model;

    //protected $connection = 'laravel5.5';
}