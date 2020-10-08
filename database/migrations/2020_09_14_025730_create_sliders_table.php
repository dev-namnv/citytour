<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSlidersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable()->comment('Tiêu đề');
            $table->string('heading')->comment('Phần mở đầu');
            $table->string('image')->comment('Ảnh');
            $table->string('description')->comment('Giới thiệu');
            $table->string('button')->nullable()->comment('Button');
            $table->text('frame')->nullable()->comment('Frame');
            $table->integer('sort_order')->default(0)->comment('Thứ tự sắp xếp');
            $table->boolean('active')->default(ACTIVE)->comment('Trạng thái: 0. Ẩn, 1. Hiện thị');
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
        Schema::dropIfExists('sliders');
    }
}
