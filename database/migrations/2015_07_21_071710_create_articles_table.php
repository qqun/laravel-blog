<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cat_id')->index();
            $table->string('title');
            $table->string('thumb');    //图片

            $table->string('keyword');
            $table->string('description');

            $table->text('content');
            $table->string('author')->default('');
            $table->string('tags')->default('');

            $table->integer('type')->default(0);    //0 普通，1置顶，2+ 保留
            $table->integer('status')->default(0);  //1 显示，0 不显示
            $table->string('url')->default('');  //外链或者文件
            $table->string('link')->default(''); //引用链接

            $table->integer('hits')->default(0);
            $table->integer('heart')->default(0);

            $table->softDeletes();
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
        Schema::drop('articles');
    }

}
