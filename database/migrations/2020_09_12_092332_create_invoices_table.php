<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên hóa đơn');
            $table->string('sku')->unique()->comment('Mã hóa đơn');

            $table->float('sub_cost')->comment('Giá trị đơn hàng');
            $table->float('vat_cost')->comment('Thuế VAT');
            $table->float('ship_cost')->comment('Phí ship')->nullable();
            $table->float('total_cost')->comment('Tổng giá trị');

            $table->string('address')->comment('Địa chỉ');
            $table->string('email')->comment('Địa chỉ Email');
            $table->string('message')->nullable()->comment('Lời nhắn');

            $table->string('payment_method')
                ->comment('Phương thức thanh toán: thẻ tín dung, thánh toán trực tiếp ...');
//            $table->boolean('status');
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
        Schema::dropIfExists('invoices');
    }
}
