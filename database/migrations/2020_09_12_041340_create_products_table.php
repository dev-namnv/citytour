<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên sản phẩm');
            $table->string('slug')->unique()->comment('Slug');
            $table->string('image')->comment('Ảnh đại diện');
            $table->float('original_price')->nullable()->comment('Giá gốc');
            $table->float('price')->comment('Giá bán');
            $table->integer('quantity')->default(0)->comment('Số lượng');
            $table->text('intro')->comment('Giới thiệu');
            $table->text('description')->comment('Mô tả');
            $table->boolean('active')->default(ACTIVE)->comment('Trạng thái: 0. Ẩn, 1. Hiện thị');
            $table->unsignedBigInteger('user_id')->comment('Người tạo');
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
        Schema::dropIfExists('products');
    }
}
