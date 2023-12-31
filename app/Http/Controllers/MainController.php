<?php

namespace App\Http\Controllers;

use App\Models\Log;
use Illuminate\Http\Request;

class MainController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $check = Log::where('visitor_ip', $request->ip())->whereDate('created_at', '=', (new \DateTime())->format('Y-m-d'))->first();

        if(!isset($check)){
            Log::create(['visitor_ip' => $request->ip()]);
        }

        return view('main.page.index', [
            'user' => (new \DateTime())->format('Y-m-d')
        ]);

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
    public function show(string $id)
    {
        //
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
