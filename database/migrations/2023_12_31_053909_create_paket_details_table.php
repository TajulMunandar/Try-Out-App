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
        Schema::create('paket_details', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('paket_id')->constrained('pakets')->onUpdate('cascade')->onDelete('restrict');
            $table->index('paket_id');
            $table->foreignId('prodi_id')->constrained('prodis')->onUpdate('cascade')->onDelete('restrict');
            $table->index('prodi_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paket_details');
    }
};
