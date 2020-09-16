<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('subject')->comment('Tiêu đề liên hệ');
            $table->string('full_name')->comment('Họ tên người liên hệ');
            $table->string('email')->comment('Email');
            $table->text('message')->comment('Lời nhắn');
            $table->string('geoip')->comment('Mã quốc gia hoặc địa chỉ IP')->nullable();
            $table->smallInteger('status')->default(TICKET_OPEN)->comment('Trạng thái liên hệ');
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
        Schema::dropIfExists('contacts');
    }
}
