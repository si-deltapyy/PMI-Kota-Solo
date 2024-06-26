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
        Schema::create('personil_narahubung', function (Blueprint $table) {
            $table->id('id_narahubung');
            $table->string('nama_lengkap');
            $table->string('posisi');
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
        Schema::dropIfExists('personil_narahubung');
    }
};
