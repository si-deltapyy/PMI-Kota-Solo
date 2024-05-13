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
            $table->id();
            $table->unsignedBigInteger('jenisKejadian_id');
            $table->unsignedBigInteger('relawan_id');
            $table->date('tanggal_kejadian');
            $table->string('lokasi');
            $table->string('update');
            $table->string('dukungan_inter');
            $table->text('keterangan');
            $table->string('akses_lokasi');
            $table->enum('kebutuhan', ['a', 'b']);
            $table->string('giat_pemerintah');
            $table->enum('hambatan', ['a', 'b']);
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('assesment_id');
            $table->unsignedBigInteger('dampak_id');
            $table->unsignedBigInteger('mobilisasi_sd_id');
            $table->unsignedBigInteger('giat_pmi_id');
            $table->unsignedBigInteger('dokumentasi_id');
            $table->unsignedBigInteger('narahubung_id');
            $table->unsignedBigInteger('petugas_posko_id');
            $table->timestamps();

            $table->foreign('jenisKejadian_id')->references('id')->on('jenis_kejadian')->onDelete('CASCADE');
            $table->foreign('relawan_id')->references('id')->on('relawan')->onDelete('CASCADE');
            $table->foreign('admin_id')->references('id')->on('petugas_pmi')->onDelete('CASCADE');
            $table->foreign('assesment_id')->references('id')->on('assesment')->onDelete('CASCADE');
            $table->foreign('dampak_id')->references('id')->on('dampak')->onDelete('CASCADE');
            $table->foreign('mobilisasi_sd_id')->references('id')->on('mobilisasi_sd')->onDelete('CASCADE');
            $table->foreign('giat_pmi_id')->references('id')->on('giat_pmi')->onDelete('CASCADE');
            $table->foreign('dokumentasi_id')->references('id')->on('lampiran_dokumentasi')->onDelete('CASCADE');
            $table->foreign('narahubung_id')->references('id')->on('personil_narahubung')->onDelete('CASCADE');
            $table->foreign('petugas_posko_id')->references('id')->on('petugas_posko')->onDelete('CASCADE');
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
