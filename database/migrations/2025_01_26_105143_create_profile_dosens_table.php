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
        Schema::create('profile_dosens', function (Blueprint $table) {
            $table->id();
            $table->string('nip')->nullable();;
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('email')->nullable();
            $table->string('telpon')->nullable();
            $table->string('gscholar')->nullable();
            $table->string('scopus')->nullable();
            $table->string('sinta')->nullable();
            $table->string('s1')->nullable();
            $table->string('s2')->nullable();
            $table->string('s3')->nullable();
            $table->string('minat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile_dosens');
    }
};
