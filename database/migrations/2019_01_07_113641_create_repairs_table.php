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
            $table->string('is_finished', '56')->nullable(true)->comment('是否完成');
            $table->string('address', '255')->nullable(true)->comment('地址');
            $table->string('name', '56')->nullable(true)->comment('用户名');
            $table->integer('user_id')->nullable(true)->comment('创建人ID');
            $table->dateTime('published_at')->nullable()->comment('发布时间');
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
