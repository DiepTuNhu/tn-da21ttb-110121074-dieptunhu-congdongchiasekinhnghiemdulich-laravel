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
        Schema::table('user_reward', function (Blueprint $table) {
            $table->boolean('user_confirmed')->default(false)->after('delivered'); // Thêm cột user_confirmed
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_reward', function (Blueprint $table) {
            $table->dropColumn('user_confirmed'); // Xóa cột user_confirmed nếu rollback
        });
    }
};
