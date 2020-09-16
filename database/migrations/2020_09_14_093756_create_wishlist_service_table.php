<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWishlistServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wishlist_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->comment('ID dịch vụ')->nullable();
            $table->unsignedBigInteger('user_id')->comment('ID người dùng');
            $table->timestamps();

            // Foreign key
            $table->foreign('service_id')->references('id')->on('services');
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
        Schema::dropIfExists('wishlist_service');
    }
}
