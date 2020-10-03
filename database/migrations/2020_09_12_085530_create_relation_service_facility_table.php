<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationServiceFacilityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relation_service_facility', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->comment('ID dịch vụ');
            $table->unsignedBigInteger('facility_id')->comment('ID cơ sở vật chất');
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
        Schema::dropIfExists('relation_service_facility');
    }
}
