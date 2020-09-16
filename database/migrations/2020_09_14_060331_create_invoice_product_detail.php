<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceProductDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_product_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable()->comment('ID hóa đơn');
            $table->unsignedBigInteger('product_id')->nullable()->comment('ID sản phẩm');
            $table->integer('quantity')->comment('Số lượng');
            $table->timestamps();

            // Foreign key
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_product_detail');
    }
}
