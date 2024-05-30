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
        Schema::create('dampak', function (Blueprint $table) {
            $table->id('id_dampak');
            $table->unsignedBigInteger('fk_id_korban_terdampak');
            $table->unsignedBigInteger('fk_id_kerusakan_rumah');
            $table->unsignedBigInteger('fk_id_kerusakan_fasil_sosial');
            $table->unsignedBigInteger('fk_id_kerusakan_infrastruktur');
            $table->unsignedBigInteger('fk_id_pengungsian');
            $table->timestamps();

            $table->foreign('fk_id_korban_terdampak')->references('id_korban_terdampak')->on('korban_terdampak')->onDelete('CASCADE');
            $table->foreign('fk_id_kerusakan_rumah')->references('id_kerusakan_rumah')->on('kerusakan_rumah')->onDelete('CASCADE');
            $table->foreign('fk_id_kerusakan_fasil_sosial')->references('id_kerusakan_fasil_sosial')->on('kerusakan_fasil_sosial')->onDelete('CASCADE');
            $table->foreign('fk_id_kerusakan_infrastruktur')->references('id_kerusakan_infrastruktur')->on('kerusakan_infrastruktur')->onDelete('CASCADE');
            $table->foreign('fk_id_pengungsian')->references('id_pengungsian')->on('pengungsian')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dampak');
    }
};
