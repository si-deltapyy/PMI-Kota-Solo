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
        Schema::create('assessment', function (Blueprint $table) {
            $table->id('id_assessment');
            $table->unsignedBigInteger('id_relawan');
            $table->unsignedBigInteger('id_report');
            $table->timestamp('timestamp_verifikasi');
            $table->text('hasil_verifikasi');
            $table->timestamps();

            $table->foreign('id_relawan')->references('id_relawan')->on('relawan')->onDelete('CASCADE');
            $table->foreign('id_report')->references('id_report')->on('reports')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assesment');
    }
};
