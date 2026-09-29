<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pelanggan.index', ['pelanggan' => Pelanggan::orderBy('namapelanggan')->get()]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pelanggan.form', ['pelanggan' => new Pelanggan]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'namapelanggan' => 'required|max:200',
            'is_man' => 'nullable|boolean',
            'nohp' => 'required|max:15',
            'alamat' => 'required|max:255'
        ]);

        $data['is_man'] = $request->boolean('is_man');
        Pelanggan::create($data);

        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelanggan $pelanggan)
    {
        return view('pelanggan.form', compact('pelanggan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
         $data = $request->validate([
            'namapelanggan' => 'required|max:200',
            'is_man' => 'nullable|boolean',
            'nohp' => 'required|max:15',
            'alamat' => 'required|max:255'
        ]);

        $data['is_man'] = $request->boolean('is_man');
        $pelanggan->update($data);
                
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil diubah.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();
        return redirect()->route('pelanggan.index')->with('success', 'Pelanggan berhasil dihapus.');
    }
}
