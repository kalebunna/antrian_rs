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
        Schema::create('antrian_resepsionis_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('antrian_id');
            $table->foreignId('resepsionis_id');
            $table->boolean('status');
            $table->foreign('resepsionis_id')->references('id')->on('resepsionis')->onDelete('restrict');
            $table->foreign('antrian_id')->references('id')->on('antrians')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrian_resepsionis_statuses');
    }
};
