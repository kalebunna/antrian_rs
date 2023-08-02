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
        Schema::create('arahkans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('poli_id');
            $table->foreignId('antrian_id');
            $table->string('no_antrian');
            $table->integer('status');
            $table->boolean('active');
            $table->foreign('poli_id')->references('id')->on('polis')->onDelete('restrict');
            $table->foreign('antrian_id')->references('id')->on('antrians')->onDelete('restrict');
            $table->dateTime('tanggal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arahkans');
    }
};
