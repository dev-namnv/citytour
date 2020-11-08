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
            $table->unsignedBigInteger('invoice_id')->comment('ID hóa đơn');
            $table->smallInteger('adult_count')->comment('Số lượng người lớn');
            $table->smallInteger('child_count')->comment('Số lượng trẻ em');
            $table->float('adult_price', 12, 3)->comment('Giá người lớn');
            $table->float('child_price', 12, 3)->comment('Giá trẻ em');
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
