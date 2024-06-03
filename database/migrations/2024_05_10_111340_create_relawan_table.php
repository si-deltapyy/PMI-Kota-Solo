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
        Schema::create('relawan', function (Blueprint $table) {
            $table->id('id_relawan');
            $table->unsignedBigInteger('id_user');
            $table->string('lokasi_relawan');
            $table->enum('status_relawan', ['Di Tempat', 'Tidak Di Tempat']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relawan');
    }
};
