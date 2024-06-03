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
        Schema::create('giat_pmi', function (Blueprint $table) {
            $table->id('id_giatpmi');
            $table->unsignedBigInteger('id_evakuasikorban');
            $table->unsignedBigInteger('id_layanankorban');
            $table->timestamps();

            $table->foreign('id_evakuasikorban')->references('id_evakuasikorban')->on('evakuasi_korban')->onDelete('CASCADE');
            $table->foreign('id_layanankorban')->references('id_layanankorban')->on('layanan_korban')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('giat_pmi');
    }
};
