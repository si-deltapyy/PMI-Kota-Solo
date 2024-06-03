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
            $table->boolean('staf_markas_kabkota');
            $table->boolean('staf_markas_prov');
            $table->boolean('staf_markas_pusat');
            $table->boolean('relawan_pmi_kabkota');
            $table->boolean('relawan_pmi_prov');
            $table->boolean('relawan_pmi_linprov');
            $table->boolean('sukarelawan_sip');
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
