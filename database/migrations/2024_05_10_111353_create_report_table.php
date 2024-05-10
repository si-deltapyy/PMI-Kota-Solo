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
            $table->id();
            $table->unsignedBigInteger('relawan_id');
            $table->unsignedBigInteger('admin_id');
            $table->string('lokasi');
            $table->enum('status', ['On_Proses', 'Selesai', 'Dalam_Penanganan']);
            $table->timestamps();

            $table->foreign('relawan_id')->references('id')->on('relawan')->onDelete('CASCADE');
            $table->foreign('admin_id')->references('id')->on('petugas_pmi')->onDelete('CASCADE');
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
