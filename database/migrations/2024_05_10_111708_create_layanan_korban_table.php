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
        Schema::create('layanan_korban', function (Blueprint $table) {
            $table->id('id_layanankorban');
            $table->unsignedBigInteger('id_assessment');
            $table->string('distribusi');
            $table->string('dapur_umum');
            $table->timestamps();

            $table->foreign('id_assessment')->references('id_assessment')->on('assessment')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('layanan_korban');
    }
};
