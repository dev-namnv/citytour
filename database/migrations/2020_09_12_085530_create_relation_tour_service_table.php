<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationTourServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_tour_service', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tour_id')->comment('ID tour');
            $table->unsignedBigInteger('service_id')->comment('ID dịch vụ');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('relation_tour_service');
    }
}
