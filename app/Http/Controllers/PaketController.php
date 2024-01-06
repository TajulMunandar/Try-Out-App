<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use App\Models\PaketDetail;
use App\Models\PaketSoal;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pakets = Paket::all();

        return view('main.page.paket')->with(compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Paket $paket_main)
    {
        $paketSoal = PaketSoal::all();
        $pakets = PaketDetail::where('paket_id', $paket_main->id)->get();
        return view('main.page.paket_detail')->with(compact('pakets', 'paket_main', 'paketSoal'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
