<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checked', function (Blueprint $table) {
            $table->id();
            $table->dateTime('start_date');
            $table->dateTime('checked_date')->nullable();
            $table->integer('status')->nullable();
            $table->integer('schedule_id');
            $table->integer('tour_id');
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
        Schema::dropIfExists('checked');
    }
}
