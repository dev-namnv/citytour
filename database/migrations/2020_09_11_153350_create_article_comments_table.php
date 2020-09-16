<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticleCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_comments', function (Blueprint $table) {
            $table->id();
            $table->text('content')->comment('Nội dung bình luận');
            $table->unsignedBigInteger('reply_for')->nullable()->comment('Trả lời bình luận');
            $table->boolean('active')->default(ACTIVE)->comment('Trạng thái: 0. Ẩn, 1. Hiện thị');
            $table->unsignedBigInteger('user_id')->comment('ID người tạo');
            $table->unsignedBigInteger('article_id')->comment('ID bài viết');
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('article_id')->references('id')->on('articles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('article_comments');
    }
}
