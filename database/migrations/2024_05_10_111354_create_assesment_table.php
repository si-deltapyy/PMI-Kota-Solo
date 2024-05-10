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
        Schema::create('assesment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relawan_id');
            $table->unsignedBigInteger('report_id');
            $table->string('hasil_verivikasi');
            $table->timestamps();

            $table->foreign('relawan_id')->references('id')->on('relawan')->onDelete('CASCADE');
            $table->foreign('report_id')->references('id')->on('reports')->onDelete('CASCADE');
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
