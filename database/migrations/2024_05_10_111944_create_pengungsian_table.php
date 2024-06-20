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
            $table->integer('kurang_dari_5');
            $table->integer('atr_5_sampai_18');
            $table->integer('lebih_dari_18');
            $table->integer('jumlah');
            $table->integer('kk');
            $table->integer('jiwa');
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
