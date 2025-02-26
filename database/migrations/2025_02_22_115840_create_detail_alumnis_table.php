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
        Schema::create('detail_alumnis', function (Blueprint $table) {
            $table->id();
            $table->string('nama')->nullable();
            $table->string('nim')->nullable();
            $table->string('angkatan')->nullable();
            $table->string('lulus')->nullable();
            $table->string('ipk')->nullable();
            $table->string('email')->nullable();
            $table->string('telpon')->nullable();
            $table->string('foto')->nullable();
            $table->string('judul_skripsi')->nullable();
            $table->string('testimoni')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_alumnis');
    }
};
