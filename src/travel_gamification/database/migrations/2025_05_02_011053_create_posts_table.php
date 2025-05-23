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
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 255)->nullable();
            $table->text('content')->nullable();
            $table->string('address', 255)->nullable();
            $table->string('price', 255)->nullable();
            $table->string('post_type', 50)->nullable();
            $table->string('opening_hours')->nullable(); 
            $table->string('phone')->nullable();
            $table->string('status', 5)->nullable();
            $table->float('average_rating')->default(0);
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('destination_id')->nullable();
            $table->unsignedInteger('utility_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('utility_id')->references('id')->on('utilities')->onDelete('cascade')->onUpdate('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
