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
        Schema::create('mobilisasi_sd', function (Blueprint $table) {
            $table->id('id_mobilisasi_sd');
            $table->unsignedBigInteger('fk_id_personil');
            $table->unsignedBigInteger('fk_id_tsr');
            $table->unsignedBigInteger('fk_id_alat_tdb');
            $table->timestamps();

            $table->foreign('fk_id_personil')->references('id_personil')->on('personil')->onDelete('CASCADE');
            $table->foreign('fk_id_tsr')->references('id_tsr')->on('tsr')->onDelete('CASCADE');
            $table->foreign('fk_id_alat_tdb')->references('id_alat_tdb')->on('alat_tdb')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mobilisasi_sd');
    }
};
