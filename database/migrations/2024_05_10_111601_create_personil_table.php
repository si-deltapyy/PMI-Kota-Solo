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
            $table->string('pengurus');
            $table->string('staf_markas_kabkota');
            $table->string('staf_markas_prov');
            $table->string('staf_markas_pusat');
            $table->string('relawan_pmi_kabkota');
            $table->string('relawan_pmi_prov');
            $table->string('relawan_pmi_linprov');
            $table->string('sukarelawan_sip');
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
