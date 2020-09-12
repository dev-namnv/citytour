<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên dịch vụ');
            $table->string('slug')->unique()->comment('Slug');
            $table->string('address')->comment('Địa chỉ');
            $table->text('description')->comment('Mô tả');
            $table->text('content')->comment('Nội dung dịch vụ');
            $table->jsonb('schedule')->comment('Lịch trình');
            $table->smallInteger('type')
                ->comment('Loại dịch vụ: 10. Tour, 20. Hotel, 30. Transfer, 40. Restaurant');
            $table->jsonb('google_map')->nullable()->comment('Google map');
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
        Schema::dropIfExists('services');
    }
}
