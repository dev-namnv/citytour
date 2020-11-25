<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToursTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên tour');
            $table->string('slug')->unique()->comment('Slug');
            $table->string('address')->comment('Địa chỉ');
            $table->text('description')->comment('Mô tả');
            $table->string('thumbnail')->comment('Hình thu nhỏ');
            $table->string('banner')->comment('Banner');
            $table->text('content')->comment('Nội dung dịch vụ');
            $table->float('adult_price', 12, 3)->nullable()->comment('Giá người lớn');
            $table->float('child_price', 12, 3)->comment('Giá trẻ em');
            $table->jsonb('google_map')->nullable()->comment('Google map');
            $table->boolean('publish')->default(PUBLISH)->comment('Trạng thái công khai: 0. Công khai, 1. Ẩn');
            $table->boolean('active')->default(NOT_ACTIVE)->comment('Trạng thái: 0. Chặn, 1. Cho phép');
            $table->unsignedBigInteger('category_id')->comment('ID danh mục tour');
            $table->unsignedBigInteger('guide_id')->comment('ID hướng dẫn viên');
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
        Schema::dropIfExists('tours');
    }
}
