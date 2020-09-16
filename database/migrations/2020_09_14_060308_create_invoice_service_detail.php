<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoiceServiceDetail extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_service_detail', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id')->nullable()->comment('ID hóa đơn');
            $table->unsignedBigInteger('service_id')->nullable()->comment('ID dịch vụ');
            $table->integer('count_adult')->comment('Số người lớn');
            $table->integer('count_children')->comment('Số trẻ nhỏ');
            $table->timestamps();

            // Foreign key
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->foreign('service_id')->references('id')->on('services');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoice_service_detail');
    }
}
