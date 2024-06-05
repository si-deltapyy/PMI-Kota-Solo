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
            $table->unsignedBigInteger('id_korban_terdampak');
            $table->unsignedBigInteger('id_kerusakan_rumah');
            $table->unsignedBigInteger('id_kerusakan_fasil_sosial');
            $table->unsignedBigInteger('id_kerusakan_infrastruktur');
            $table->unsignedBigInteger('id_pengungsian');
            $table->unsignedBigInteger('id_kejadian');
            $table->timestamps();

            $table->foreign('id_korban_terdampak')->references('id_korban_terdampak')->on('korban_terdampak')->onDelete('CASCADE');
            $table->foreign('id_kerusakan_rumah')->references('id_kerusakan_rumah')->on('kerusakan_rumah')->onDelete('CASCADE');
            $table->foreign('id_kerusakan_fasil_sosial')->references('id_kerusakan_fasil_sosial')->on('kerusakan_fasil_sosial')->onDelete('CASCADE');
            $table->foreign('id_kerusakan_infrastruktur')->references('id_kerusakan_infrastruktur')->on('kerusakan_infrastruktur')->onDelete('CASCADE');
            $table->foreign('id_pengungsian')->references('id_pengungsian')->on('pengungsian')->onDelete('CASCADE');
            $table->foreign('id_kejadian')->references('id_kejadian')->on('kejadian_bencana')->onDelete('CASCADE');
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
