<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->text('content')->nullable()->comment('Nội dung đánh giá');
            $table->smallInteger('star')->default(STAR_DEFAULT)->comment('Sao đánh giá');
            $table->boolean('active')->default(ACTIVE)->comment('Trạng thái: 0. Ẩn, 1. Hiện thị');
            $table->unsignedBigInteger('user_id')->comment('ID người tạo');
            $table->unsignedBigInteger('service_id')->comment('ID dịch vụ');
            $table->timestamps();

            // Foreign key
            $table->foreign('user_id')->references('id')->on('users');
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
        Schema::dropIfExists('reviews');
    }
}
