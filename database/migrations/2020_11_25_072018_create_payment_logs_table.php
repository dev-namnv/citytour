<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_logs', function (Blueprint $table) {
            $table->id();
            $table->float('deposit_cost', 12, 3)->comment('Chi phí đặt cọc (đã trả)');
            $table->float('total_cost', 12, 3)->comment('Tổng giá trị');
            $table->string('payment_type')->comment('Hình thức thanh toán');
            $table->string('payment_code')->comment('Mã thanh toán app');
            $table->string('customer_name')->comment('Tên khách hàng');
            $table->string('customer_email')->nullable()->comment('Địa chỉ Email');
            $table->string('customer_phone')->comment('Số điện thoại');

            $table->unsignedBigInteger('tour_id')->comment('ID Tour');
            $table->unsignedBigInteger('guide_id')->comment('ID hướng dẫn viên');
            $table->unsignedBigInteger('user_id')->nullable()->nullable()->comment('ID khách hàng');
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
        Schema::dropIfExists('payment_logs');
    }
}
