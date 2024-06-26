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
        Schema::create('kerusakan_fasil_sosial', function (Blueprint $table) {
            $table->id('id_kerusakan_fasil_sosial');
            $table->string('sekolah');
            $table->string('tempat_ibadah');
            $table->string('rumah_sakit');
            $table->string('pasar');
            $table->string('gedung_pemerintah');
            $table->string('lain_lain');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kerusakan_fasil_sosial');
    }
};
