<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationArticleTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_article_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('article_id')->comment('ID bài viết');
            $table->unsignedBigInteger('tag_id')->comment('ID tag');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_article_tag');
    }
}
