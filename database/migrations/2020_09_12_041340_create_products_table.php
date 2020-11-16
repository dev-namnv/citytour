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
            $table->string('sku')->unique()->comment('Mã sản phẩm');
            $table->string('image')->comment('Ảnh đại diện');
            $table->float('origin_price', 12, 3)->nullable()->comment('Giá gốc');
            $table->float('price', 12, 3)->comment('Giá bán');
            $table->integer('stocks')->default(0)->comment('Số lượng');
            $table->text('intro')->comment('Giới thiệu');
            $table->text('description')->comment('Mô tả');
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
        Schema::dropIfExists('products');
    }
}
