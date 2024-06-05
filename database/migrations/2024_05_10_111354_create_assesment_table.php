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
        Schema::create('assessment', function (Blueprint $table) {
            $table->id('id_assessment');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_report');
            $table->timestamp('timestamp_verifikasi');
            $table->text('hasil_verifikasi');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assesment');
    }
};
