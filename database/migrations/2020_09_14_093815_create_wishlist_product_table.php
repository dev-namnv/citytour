<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist_product', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('ID sản phẩm')->nullable();
            $table->unsignedBigInteger('user_id')->comment('ID người dùng');
            $table->timestamps();

            // Foreign key
            $table->foreign('product_id')->references('id')->on('products');
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
        Schema::dropIfExists('wishlist_product');
    }
}
