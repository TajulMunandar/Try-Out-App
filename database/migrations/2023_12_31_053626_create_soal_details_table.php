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
        Schema::create('soal_details', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->foreignId('soal_id')->constrained('soals')->onUpdate('cascade')->onDelete('restrict');
            $table->index('soal_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soal_details');
    }
};
