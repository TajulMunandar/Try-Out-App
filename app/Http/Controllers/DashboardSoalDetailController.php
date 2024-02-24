<?php

namespace App\Http\Controllers;

use App\Imports\SoalImport;
use App\Models\Jawaban;
use App\Models\SoalDetail;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class DashboardSoalDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        return view('dashboard.page.paket-soal.soal.soal-detail.create', [
            'soal_id' => $request->query->get('soal_id'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validatedDataQuiz = $request->validate([
                'name' => 'required|max:255',
                'soal_id' => 'required'
            ]);

            $soal_detail = SoalDetail::create($validatedDataQuiz);
            foreach ($request->answer as $key => $value) {
                $status = false;

                if ($key == $request->jawaban) {
                    $status = true;
                }

                Jawaban::create([
                    'name' => $value,
                    'status' => $status,
                    'soal_detail_id' => $soal_detail->id
                ]);
            }

            jawaban::create([
                'name' => 'Tidak Menjawab',
                'status' => false,
                'soal_detail_id' => $soal_detail->id
            ]);

            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('success', 'Soal Detail baru berhasil dibuat!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('failed', $e->getMessage());
        } catch (\Exception $e) {
            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('failed', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        return view('dashboard.page.paket-soal.soal.soal-detail.edit', [
            'soal_id' => $request->query->get('soal_id'),
            'soal_detail' => SoalDetail::where('id', $id)->first(),
            'jawabans' => jawaban::where('soal_detail_id', $id)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validatedDataQuiz = $request->validate([
                'name' => 'required|max:255',
                'soal_id' => 'required'
            ]);

            foreach ($request->answer as $key => $value) {
                $status = false;

                if ($key == $request->jawaban) {
                    $status = true;
                }

                jawaban::where('soal_detail_id', $id)->where('id', $request->idQuestion[$key])->update([
                    'name' => $value,
                    'status' => $status,
                ]);
            }
            SoalDetail::where('id', $id)->update($validatedDataQuiz);

            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('success', 'Soal Detail berhasil diperbaharui!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('failed', $e->getMessage());
        } catch (\Exception $e) {
            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('failed', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $soal_detail = SoalDetail::whereId($id)->first();
            $jawabans = jawaban::where('soal_detail_id', $id)->get();
            foreach ($jawabans as $jawaban) {
                if ($jawaban->jawaban_mahasiswas()->exists()) {
                    return redirect("/dashboard/paket-soal/soal/{$soal_detail->soal_id}")->with('failed', "Soal Detail $soal_detail->name tidak bisa dihapus karena sedang digunakan");
                }
                jawaban::destroy($jawaban->id);
            }
            SoalDetail::destroy($id);
            return redirect("/dashboard/paket-soal/soal/{$soal_detail->soal_id}")->with('success', 'Soal Detail berhasil diperbaharui!');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect("/dashboard/paket-soal/soal/{$soal_detail->soal_id}")->with('failed', "Soal Detail $soal_detail->name tidak bisa dihapus karena sedang digunakan!");
        }
    }

    public function import(Request $request)
    {
        try {
            $soal_id = $request->soal_id;
            // dd($request->file);
            Excel::import(new SoalImport($soal_id), $request->file('file'));

            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('success', 'Data berhasil diimpor!');
        } catch (\Exception $e) {
            return redirect("/dashboard/paket-soal/soal/{$request->soal_id}")->with('failed', $e->getMessage());
        }
    }
}
