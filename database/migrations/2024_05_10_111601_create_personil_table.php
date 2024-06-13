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
        Schema::create('personil', function (Blueprint $table) {
            $table->id('id_personil');
            $table->integer('pengurus');
            $table->integer('staf_markas_kabkota');
            $table->integer('staf_markas_prov');
            $table->integer('staf_markas_pusat');
            $table->integer('relawan_pmi_kabkota');
            $table->integer('relawan_pmi_prov');
            $table->integer('relawan_pmi_linprov');
            $table->integer('sukarelawan_sip');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personil');
    }
};
