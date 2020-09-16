<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->id();
            $table->string('title')->comment('Tiêu đề log');
            $table->smallInteger('type')->comment('Loại hoạt động của tài khoản');
            $table->integer('points')->comment('Điểm số');
            $table->unsignedBigInteger('user_id')->comment('ID người dùng');
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_logs');
    }
}
