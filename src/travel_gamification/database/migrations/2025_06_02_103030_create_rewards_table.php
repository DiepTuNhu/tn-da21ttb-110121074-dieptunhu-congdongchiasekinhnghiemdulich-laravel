<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rewards', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name'); // Tên phần thưởng
            $table->text('description')->nullable(); // Mô tả phần thưởng
            $table->integer('cost_points'); // Điểm cần để đổi
            $table->enum('type', ['virtual', 'physical'])->default('virtual'); // Loại quà
            $table->integer('stock')->default(0); // Số lượng tồn kho
            $table->string('image')->nullable(); // Hình ảnh minh họa
            $table->boolean('active')->default(1); // Có đang được phép đổi không
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
