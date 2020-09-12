<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationProductCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_product_category', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->comment('ID sản phẩm');
            $table->unsignedBigInteger('category_id')->comment('ID danh mục');
            $table->timestamps();

            // Foreign key
            $table->foreign('product_id')->references('id')->on('products');
            $table->foreign('category_id')->references('id')->on('product_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_product_category');
    }
}
