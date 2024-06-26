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
        Schema::create('petugas_posko', function (Blueprint $table) {
            $table->id('id_petugas_posko');
            $table->string('nama_lengkap');
            $table->string('kontak');
            $table->unsignedBigInteger('id_kejadian');
            $table->timestamps();

            $table->foreign('id_kejadian')->references('id_kejadian')->on('kejadian_bencana')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('petugas_posko');
    }
};
