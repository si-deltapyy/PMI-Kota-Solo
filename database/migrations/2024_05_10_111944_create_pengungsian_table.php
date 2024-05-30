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
        Schema::create('pengungsian', function (Blueprint $table) {
            $table->id('id_pengungsian');
            $table->string('nama_lokasi');
            $table->double('laki_laki');
            $table->double('perempuan');
            $table->integer('<5');
            $table->integer('>5_<=18');
            $table->integer('>18');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengungsian');
    }
};
