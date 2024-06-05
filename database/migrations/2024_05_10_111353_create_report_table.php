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
            $table->unsignedBigInteger('id_user');
            $table->string('lokasi');
            $table->timestamp('timestamp_report');
            $table->enum('status', ['On_Proses', 'Selesai', 'Dalam_Penanganan']);
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE');
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
