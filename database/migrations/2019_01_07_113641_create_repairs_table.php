<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('part', '56')->nullable(true)->comment('哪部分的错误');
            $table->string('description', '255')->nullable(true)->comment('描述');
            $table->string('state', '56')->nullable(true)->comment('状态');
            $table->string('address', '255')->nullable(true)->comment('报修地址');
            $table->string('username', '56')->nullable(true)->comment('用户名');
            $table->integer('user_id')->nullable(true)->comment('创建人ID');
            $table->string('image','255')->nullable(true)->comment('图片');
            $table->dateTime('published_at')->nullable(true)->comment('发布时间');
            $table->dateTime('repair_time')->nullable(true)->comment('上门维修时间');
            $table->dateTime('finish_time')->nullable(true)->comment('完成时间');
            $table->timestamps();
        });

        //表备注
        DB::statement("ALTER TABLE `repairs` COMMENT '报修报事表';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repairs');
    }
}
