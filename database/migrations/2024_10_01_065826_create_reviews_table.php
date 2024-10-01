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
            $table->id(); // Cột id tự động tăng
            $table->unsignedBigInteger('user_id'); // ID người dùng
            $table->unsignedBigInteger('product_id'); // ID sản phẩm
            $table->integer('rating')->unsigned()->default(1); // Đánh giá từ 1 đến 5
            $table->text('comment')->nullable(); // Bình luận của người dùng
            $table->timestamps(); // Thời gian tạo và cập nhật

            // Khóa ngoại
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
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

