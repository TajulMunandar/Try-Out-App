<?php

namespace App\Http\Controllers;

use App\Models\PaketDetail;
use App\Models\ViewScore;
use Illuminate\Http\Request;

class DashboardPenilaianController extends Controller
{
    public function index()
    {
        $paketDetailsQuery = PaketDetail::latest();

        if (auth()->user()->is_admin == 2) {
            $prodiId = auth()->user()->dosens->prodi_id;
            $paketDetailsQuery->where('prodi_id', $prodiId);
        }

        $paketDetails = $paketDetailsQuery->get();
        $firstPaketDetails = $paketDetailsQuery->first();

        $penilaian = [];

        if (auth()->user()->is_admin == 2 && isset($firstPaketDetails)) {
            $penilaian = ViewScore::where('mahasiswa_prodi_id', $prodiId)
                ->where('paket_detail_id', $firstPaketDetails->id)
                ->latest()
                ->get();
        } elseif (isset($firstPaketDetails)) {
            $penilaian = ViewScore::where('paket_detail_id', $firstPaketDetails->id)
                ->latest()
                ->get();
        }

        $chartData = [];
        $chartLabels = [];

        foreach ($penilaian as $score) {
            $calculatedScore = number_format((100 / $score['total_jawaban']) * $score['score_benar'], 2);

            // Check if the label already exists in chartLabels
            $index = array_search($calculatedScore, $chartLabels);

            if ($index !== false) {
                // If the label already exists, increment the corresponding value in chartData
                $chartData[$index]++;
            } else {
                // If the label does not exist, add it to chartLabels and set the corresponding value in chartData to 1
                $chartLabels[] = $calculatedScore;
                $chartData[] = 1;
            }
        }

        array_multisort($chartLabels, $chartData);

        // Result
        $sortedArray = [
            'chartData' => $chartData,
            'chartLabels' => $chartLabels,
        ];


        return view('dashboard.page.penilaian.index', [
            'scores' => $penilaian,
            'paket_details' => $paketDetails,
            'sortedArray' => $sortedArray,
        ]);
    }
}
