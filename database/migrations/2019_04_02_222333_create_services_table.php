<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_address', '255')->nullable(true)->comment('用户地址');
            $table->string('type', '56')->nullable(true)->comment('代取快递express/预约洗车/家庭保洁');
            $table->string('express_type','255')->nullable(true)->comment('快递类型');
            $table->string('express_num','255')->nullable(true)->comment('快递单号');
            $table->dateTime('arrived_at')->nullable(true)->comment('服务到达时间');
            $table->string('description', '255')->nullable(true)->comment('备注');
            $table->string('state', '56')->nullable(true)->comment('状态');
            $table->integer('user_id')->nullable(true)->comment('创建人ID');
            $table->dateTime('published_at')->nullable(true)->comment('发布时间');
            $table->dateTime('finish_time')->nullable(true)->comment('完成时间');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
