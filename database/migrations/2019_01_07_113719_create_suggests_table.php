<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSuggestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suggests', function (Blueprint $table) {
            $table->increments('id');
            $table->string('description', '255')->nullable(true)->comment('问题描述');
            $table->string('type', '56')->nullable(true)->comment('意见/建议');
            $table->string('image','255')->nullable(true)->comment('图片');
            $table->string('address','255')->nullable(true)->comment('地址');
            $table->string('state', '56')->nullable(true)->comment('状态');
            $table->integer('user_id')->nullable(true)->comment('创建人ID');
            $table->dateTime('published_at')->nullable(true)->comment('发布时间');
            $table->string('anonymous', '56')->nullable(true)->comment('是否匿名投诉');
            $table->timestamps();
        });

        //表备注
        DB::statement("ALTER TABLE `suggests` COMMENT '投诉建议表';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('suggests');
    }
}
