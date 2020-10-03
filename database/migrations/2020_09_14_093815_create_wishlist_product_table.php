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
