<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTopicsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('topics', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', '56')->comment('标题');
            $table->string('content', '255')->comment('内容');
            $table->string('cover','255')->comment('图片');
            $table->string('state', '56')->comment('状态');
            $table->integer('user_id')->comment('创建人ID');
            $table->dateTime('published_at')->nullable()->comment('发布时间');
            $table->timestamps();
        });

        //表备注
        DB::statement("ALTER TABLE `topics` COMMENT '社区广场表';");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('community_topics');
    }
}
