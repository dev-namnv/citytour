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
            $table->id();
            $table->string('title')->comment('Tiêu đề bài viết');
            $table->string('heading')->comment('Phần mở đầu');
            $table->string('slug')->unique()->comment('Slug');
            $table->text('content')->comment('Nội dung');
            $table->string('image')->comment('Ảnh đại diện');
            $table->unsignedBigInteger('user_id')->comment('ID tác giả');
            $table->softDeletes();
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
