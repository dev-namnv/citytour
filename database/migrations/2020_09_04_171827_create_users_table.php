<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->nullable()->comment('Tên tài khoản');
            $table->string('first_name')->comment('Tên');
            $table->string('last_name')->comment('Họ và tên');
            $table->string('email')->unique()->comment('Địa chỉ Email');
            $table->string('phone')->nullable()->comment('Số điện thoại');
            $table->string('avatar')
                ->comment('Avatar')
                ->default('https://firebasestorage.googleapis.com/v0/b/travelo-4e9da.appspot.com/o/images%2Favatar%2Fdefault.png?alt=media&token=a0cd433b-6f54-4229-9119-ff7820b481f7');
            $table->date('birthday')->nullable()->comment('Sinh nhật');
            $table->string('address')->nullable()->comment('Địa chỉ');
            $table->string('city')->nullable()->comment('Thành phố');
            $table->string('zipcode')->nullable()->comment('Zip code');
            $table->string('country')->nullable()->comment('Quốc gia');
            $table->json('google_map')->nullable()->comment('Địa chỉ Google map');
            $table->timestamp('email_verified_at')->nullable()->comment('Xác thực Email');
            $table->string('password')->comment('Mật khẩu');
            $table->boolean('role')->default(USER)
                ->comment('Role: 0. User, 1. Admin, 2. Guide');
            $table->boolean('status')->default(ACTIVE)->comment('Trạng thái: 0. Khóa, 1. Mở');
            $table->rememberToken()->comment('Ghi nhớ đăng nhập');
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
        Schema::dropIfExists('users');
    }
}
