<?php

namespace App\Http\Controllers;

use App\Models\Meja;
use Illuminate\Http\Request;

class MejaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('meja.index', ['meja' => Meja::orderBy('nomor_meja')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('meja.form', ['meja' => new Meja]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Meja::create($request->validate([
            'nomor_meja' => 'required|max:10|unique:meja,nomor_meja',
            'kapasitas' => 'required|integer|min:1|max:20'
        ]));
        return redirect()->route('meja.index')->with('success', 'Meja berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Meja $meja)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meja $meja)
    {
        return view('meja.form', compact('meja'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meja $meja)
    {
        $meja->update($request->validate([
            'nomor_meja' => 'required|max:10|unique:meja,nomor_meja' . $meja->idmeja . 'idmeja',
            'kapasitas' => 'required|integer|min:1|max:20'
        ]));
        return redirect()->route('meja.index')->with('success', 'Meja berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meja $meja)
    {
        $meja->delete();
        return redirect()->route('meja.index')->with('success', 'Meja berhasil dihapus.');
    }
}
