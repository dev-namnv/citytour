<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('Tên đối tác');
            $table->string('email')->comment('Địa chỉ Email');
            $table->string('avatar')
                ->default('https://firebasestorage.googleapis.com/v0/b/travelo-4e9da.appspot.com/o/images%2Fpartner%2Fpartner.jpg?alt=media&token=6423b859-c718-4798-b2fb-10940eac7851')
                ->comment('Avatar');
            $table->string('sku')->unique()->comment('Mã đối tác');
            $table->softDeletes();
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
        Schema::dropIfExists('partners');
    }
}
