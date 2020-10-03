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
            $table->smallInteger('type')->comment('Loại hóa đơn: 10. Service, 20. Product');
            $table->string('name')->comment('Tên hóa đơn');
            $table->string('sku')->unique()->comment('Mã hóa đơn');

            $table->float('sub_cost', 12, 3)->comment('Giá trị đơn hàng');
            $table->float('vat_cost', 12, 3)->comment('Thuế VAT');
            $table->float('ship_cost', 12, 3)->comment('Phí ship')->nullable();
            $table->float('total_cost', 12, 3)->comment('Tổng giá trị');

            $table->string('address')->comment('Địa chỉ');
            $table->string('email')->comment('Địa chỉ Email');
            $table->string('message')->nullable()->comment('Lời nhắn');

            $table->boolean('status')->default(PAYMENT_ORDERED)->comment('Trạng thái đơn hàng');
            $table->string('payment_type')->comment('Hình thức thanh toán');
            $table->string('payment_status')
                ->comment('Trạng thái thanh toán: 0. Chưa thanh toán, 1. Đã thanh toán');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID tài khoản');
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
