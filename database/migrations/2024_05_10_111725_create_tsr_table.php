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
        Schema::create('tsr', function (Blueprint $table) {
            $table->id('id_tsr');
            $table->string('medis');
            $table->string('paramedis');
            $table->string('relief');
            $table->string('logistik');
            $table->string('watsan');
            $table->string('it_telekom');
            $table->string('sheltering');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tsr');
    }
};
