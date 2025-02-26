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
        Schema::create('ketetatans', function (Blueprint $table) {
            $table->id();
            $table->integer('tahun');
            $table->integer('jml_snmptn');
            $table->integer('kuota_snmptn');
            $table->integer('jml_sbnptn');
            $table->integer('kuota_sbnptn');
            $table->integer('jml_mandiri');
            $table->integer('kuota_mandiri');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ketetatans');
    }
};
