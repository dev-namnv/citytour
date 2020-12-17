<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGuideLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('guide_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('guide_id')->comment('ID hướng dẫn viên');
            $table->unsignedBigInteger('tour_id')->comment('ID tour');
            $table->date('busy_start_at')->comment('Thời gian bắt đầu hướng dẫn viên đang bận');
            $table->date('busy_end_at')->comment('Thời gian kết thúc hướng dẫn viên đang bận');
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
        Schema::dropIfExists('guide_logs');
    }
}
