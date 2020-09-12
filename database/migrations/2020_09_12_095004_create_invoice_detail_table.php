<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_detail', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('type')->comment('Loại hóa đơn: 10. Dịch vụ, 20. Sản phẩm');
            $table->unsignedBigInteger('service_id')->nullable()->comment('ID dịch vụ');
            $table->unsignedBigInteger('product_id')->nullable()->comment('ID sản phẩm');
            $table->timestamps();

            // Foreign key
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('invoice_detail');
    }
}
