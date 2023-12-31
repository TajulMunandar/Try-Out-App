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
        Schema::create('paket_soals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('soal_id')->constrained('soals')->onUpdate('cascade')->onDelete('restrict');
            $table->index('soal_id');
            $table->foreignId('paket_detail_id')->constrained('paket_details')->onUpdate('cascade')->onDelete('restrict');
            $table->index('paket_detail_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_soals');
    }
};
