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
        Schema::create('kejadian_bencana', function (Blueprint $table) {
            $table->id('id_kejadian');
            $table->unsignedBigInteger('id_jeniskejadian');
            $table->unsignedBigInteger('id_relawan');
            $table->date('tanggal_kejadian');
            $table->string('lokasi');
            $table->string('update');
            $table->string('dukungan_internasional');
            $table->text('keterangan');
            $table->string('akses_ke_lokasi');
            $table->enum('kebutuhan', ['a', 'b']);
            $table->string('giat_pemerintah');
            $table->enum('hambatan', ['a', 'b']);
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_assessment');
            $table->unsignedBigInteger('id_dampak');
            $table->unsignedBigInteger('id_mobilisasi_sd');
            $table->unsignedBigInteger('id_giat_pmi');
            $table->unsignedBigInteger('id_dokumentasi');
            $table->unsignedBigInteger('id_narahubung');
            $table->unsignedBigInteger('id_petugas_posko');
            $table->timestamps();

            $table->foreign('id_jeniskejadian')->references('id_jeniskejadian')->on('jenis_kejadian')->onDelete('CASCADE');
            $table->foreign('id_relawan')->references('id_relawan')->on('relawan')->onDelete('CASCADE');
            $table->foreign('id_admin')->references('id_admin')->on('petugas_pmi')->onDelete('CASCADE');
            $table->foreign('id_assessment')->references('id_assessment')->on('assessment')->onDelete('CASCADE');
            $table->foreign('id_dampak')->references('id_dampak')->on('dampak')->onDelete('CASCADE');
            $table->foreign('id_mobilisasi_sd')->references('id_mobilisasi_sd')->on('mobilisasi_sd')->onDelete('CASCADE');
            $table->foreign('id_giat_pmi')->references('id_giatpmi')->on('giat_pmi')->onDelete('CASCADE');
            $table->foreign('id_dokumentasi')->references('id_dokumentasi')->on('lampiran_dokumentasi')->onDelete('CASCADE');
            $table->foreign('id_narahubung')->references('id_narahubung')->on('personil_narahubung')->onDelete('CASCADE');
            $table->foreign('id_petugas_posko')->references('id_petugas_posko')->on('petugas_posko')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kejadian_bencana');
    }
};
