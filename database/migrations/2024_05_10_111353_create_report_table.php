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
        Schema::create('reports', function (Blueprint $table) {
            $table->id('id_report');
            $table->unsignedBigInteger('fk_id_relawan');
            $table->unsignedBigInteger('fk_id_admin');
            $table->string('lokasi');
            $table->timestamp('timestamp_report');
            $table->enum('status', ['On_Proses', 'Selesai', 'Dalam_Penanganan']);
            $table->timestamps();

            $table->foreign('fk_id_relawan')->references('id_relawan')->on('relawan')->onDelete('CASCADE');
            $table->foreign('fk_id_admin')->references('id_admin')->on('petugas_pmi')->onDelete('CASCADE');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('report');
    }
};
