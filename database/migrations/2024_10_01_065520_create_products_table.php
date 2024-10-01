<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('category_id'); // Khóa ngoại đến bảng categories // Tên sản phẩm
            $table->string('detail')->nullable(); // Chi tiết sản phẩm
            $table->text('description')->nullable(); // Mô tả sản phẩm
            $table->decimal('price', 10, 2); // Giá sản phẩm, dạng decimal
            $table->string('thumbnail')->nullable();
            $table->integer('sold')->default(0); // Số lượng đã bán
            $table->integer('quantity')->default(0); // Số lượng trong kho
            $table->timestamps(); // Cột created_at và updated_at

             // Khóa ngoại
             $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
