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
            $table->unsignedBigInteger('role_id')->nullable(); // Khóa ngoại liên kết với bảng roles
            $table->string('name'); // Tên người dùng
            $table->string('email')->unique(); // Email phải duy nhất
            $table->timestamp('email_verified_at')->nullable(); // Thời gian xác minh email
            $table->string('password'); // Mật khẩu người dùng

            // Các trường bổ sung theo yêu cầu
            $table->string('number_phone', 15)->nullable(); // Số điện thoại
            $table->text('address')->nullable(); // Địa chỉ
            $table->string('avatar')->nullable(); // Đường dẫn ảnh avatar
            
            $table->rememberToken(); // Token để ghi nhớ người dùng
            $table->timestamps(); // Cột created_at và updated_at

            // Khóa ngoại cho role_id
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('set null');
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
