<?php

namespace App\Jobs;

use App\Models\JawabanMahasiswa;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QuizJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $validatedData;

    public function __construct($validatedData)
    {
        $this->validatedData = $validatedData;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach ($this->validatedData['jawaban_id'] as $jawabanId) {
            JawabanMahasiswa::create([
                'jawaban_id' => $jawabanId,
                'mahasiswa_id' => $this->validatedData['mahasiswa_id'],
                'paket_detail_id' => $this->validatedData['paket_detail_id'],
            ]);
        }
    }
}
