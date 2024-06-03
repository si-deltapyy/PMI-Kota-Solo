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
        Schema::create('alat_tdb', function (Blueprint $table) {
            $table->id('id_alat_tdb');
            $table->string('kend_ops');
            $table->string('truk_angkut');
            $table->string('truk_tanki');
            $table->string('double_cabin');
            $table->string('alat_du');
            $table->string('ambulans');
            $table->string('alat_watsan');
            $table->string('rs_lapangan');
            $table->string('alat_pkdd');
            $table->string('gudang_lapangan');
            $table->string('posko_aju');
            $table->string('alat_it_lapangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alat_tdb');
    }
};
