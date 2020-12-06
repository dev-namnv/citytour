<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCancelPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cancel_policies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên thời gian được hủy');
            $table->integer('date')->comment('Số ngày từ hiện tại đến khi tour bắt đầu');
            $table->integer('refunds')->comment('Số phần trăm hoàn trả lại');
            $table->integer('behavioral_points_deduction')->default(0)->comment('Số điểm hành vi bị trừ');
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
        Schema::dropIfExists('cancel_policies');
    }
}
