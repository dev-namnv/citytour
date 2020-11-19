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
            $table->string('sku')->unique()->comment('Mã hóa đơn');

            $table->date('start_date')->comment('Ngày khởi hành');
            $table->smallInteger('adult_count')->comment('Số lượng người lớn');
            $table->smallInteger('child_count')->comment('Số lượng trẻ em');
            $table->float('sub_cost', 12)->comment('Giá trị đơn hàng');
            $table->float('vat_cost', 12)->default(0)->comment('Thuế VAT');
            $table->float('total_cost', 12)->comment('Tổng giá trị');
            $table->string('payment_type')->comment('Hình thức thanh toán');
            $table->string('payment_code')->comment('Mã thanh toán app');
            $table->float('deposit_cost', 12, 3)->comment('Chi phí đặt cọc (đã trả)');

            $table->string('customer_name')->comment('Tên khách hàng');
            $table->string('customer_address')->comment('Địa chỉ');
            $table->string('customer_email')->nullable()->comment('Địa chỉ Email');
            $table->string('customer_phone')->comment('Số điện thoại');
            $table->string('customer_message')->nullable()->comment('Lời nhắn');
            $table->integer('status')->default(INVOICE_NEW)->comment('Trạng thái đơn hàng');

            $table->unsignedBigInteger('tour_id')->comment('ID tour');
            $table->unsignedBigInteger('guide_id')->comment('ID hướng dẫn viên');
            $table->unsignedBigInteger('user_id')->nullable()->comment('ID khách hàng');
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
