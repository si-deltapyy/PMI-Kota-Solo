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
            $table->enum('status', ['On Process', 'Aktif', 'Selesai']);

            $table->timestamps();

            $table->foreign('id_relawan')->references('id')->on('users')->onDelete('CASCADE');
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
