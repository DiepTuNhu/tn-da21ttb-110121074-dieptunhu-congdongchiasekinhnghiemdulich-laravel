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
        Schema::table('reports', function (Blueprint $table) {
            // $table->unsignedInteger('comment_id')->nullable()->after('post_id');
            $table->tinyInteger('status')->default(0)->after('comment_id');
            $table->foreign('comment_id')->references('id')->on('comments')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reports', function (Blueprint $table) {
            $table->dropForeign(['comment_id']);
            // $table->dropColumn('comment_id');
            $table->dropColumn('status');
        });
    }
};
