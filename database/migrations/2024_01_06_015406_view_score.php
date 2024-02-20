<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
            CREATE VIEW view_score AS
            SELECT
                jm.mahasiswa_id,
                pd.id AS paket_detail_id,
                m.name AS mahasiswa_name,
                pd.name AS paket_detail_name,
                m.prodi_id AS mahasiswa_prodi_id,
                COUNT(*) AS total_jawaban,
                SUM(CAST(j.status AS SIGNED)) AS score_benar,
                MAX(jm.created_at) AS created_at,
                MAX(jm.updated_at) AS updated_at
            FROM
                jawaban_mahasiswas jm
            JOIN
                jawabans j ON jm.jawaban_id = j.id
            JOIN
                mahasiswas m ON jm.mahasiswa_id = m.id
            JOIN
                paket_details pd ON jm.paket_detail_id = pd.id
            GROUP BY
                jm.mahasiswa_id, pd.id, m.name, pd.name
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS view_score');
    }
};
