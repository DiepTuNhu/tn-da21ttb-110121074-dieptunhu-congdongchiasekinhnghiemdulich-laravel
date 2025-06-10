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
        Schema::create('destination_utilities', function (Blueprint $table) {
            $table->unsignedInteger('destination_id');
            $table->unsignedInteger('utility_id');
            $table->string('status', 100)->nullable();
            // $table->integer('quality')->nullable();
            $table->double('distance')->nullable();
            $table->foreign('destination_id')->references('id')->on('destinations')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('utility_id')->references('id')->on('utilities')->onDelete('cascade')->onUpdate('cascade');

            $table->primary(['destination_id', 'utility_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('destination_utilities');
    }
};
