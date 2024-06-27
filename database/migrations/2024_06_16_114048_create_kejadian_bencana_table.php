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
            $table->unsignedBigInteger('id_admin');
            $table->unsignedBigInteger('id_relawan');
            $table->date('tanggal_kejadian');
            $table->string('lokasi');
            $table->string('update');
            $table->string('dukungan_internasional');
            $table->text('keterangan');
            $table->enum('akses_ke_lokasi', ['Accessible', 'Not Accessible']);
            $table->string('kebutuhan');
            $table->enum('giat_pemerintah', ['Ya', 'Tidak']);
            $table->string('hambatan');
            $table->unsignedBigInteger('id_assessment');
            $table->unsignedBigInteger('id_dampak');
            $table->unsignedBigInteger('id_mobilisasi_sd');
            $table->unsignedBigInteger('id_giat_pmi');
            $table->timestamp('timestamp_input')->nullable();
            $table->timestamp('timestamp_update')->nullable();
            $table->timestamps();

            $table->foreign('id_jeniskejadian')->references('id_jeniskejadian')->on('jenis_kejadian')->onDelete('CASCADE');
            $table->foreign('id_relawan')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('id_admin')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('id_assessment')->references('id_assessment')->on('assessment')->onDelete('CASCADE');
            $table->foreign('id_dampak')->references('id_dampak')->on('dampak')->onDelete('CASCADE');
            $table->foreign('id_mobilisasi_sd')->references('id_mobilisasi_sd')->on('mobilisasi_sd')->onDelete('CASCADE');
            $table->foreign('id_giat_pmi')->references('id_giatpmi')->on('giat_pmi')->onDelete('CASCADE');
            
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
