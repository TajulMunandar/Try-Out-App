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
        Schema::create('jawaban_mahasiswas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_detail_id')->constrained('soal_details')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jawaban_mahasiswas');
    }
};
