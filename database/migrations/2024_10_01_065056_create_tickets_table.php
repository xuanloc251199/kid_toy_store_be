<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('name'); // Tên vé khu vui chơi
            $table->string('place'); // Địa điểm
            $table->date('date'); // Ngày vé có hiệu lực
            $table->string('detail')->nullable(); // Chi tiết ngắn về vé
            $table->text('description')->nullable(); // Mô tả chi tiết vé
            $table->decimal('price', 10, 2); // Giá vé, dạng decimal
            $table->integer('number_ticket')->default(0); // Số lượng vé có sẵn
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tickets');
    }
}
