<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Menu;
use App\Models\Meja;
use App\Models\Pelanggan;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function index()
    {
    $pesanan = Pesanan::with(['pelanggan', 'meja', 'menu'])->latest()->get();
    return view('pesanan.index', compact('pesanan'));
    }

    public function create()
    {
        return view('pesanan.form', [
            'menu' => Menu::orderBy('namamenu')->get(),
            'meja' => Meja::where('status', 'tersedia')->orderBy('nomor_meja')->get(),
            'pelanggan' => Pelanggan::orderBy('namapelanggan')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'idpelanggan' => 'required|exists:pelanggans,idpelanggan',
            'idmeja' => 'required|exists:mejas,idmeja',
            'idmenu' => 'required|exists:menus,idmenu',
            'jumlah' => 'required|integer|min:1',
        ]);

        Pesanan::create([
            'idpelanggan' => $data['idpelanggan'],
            'idmeja' => $data['idmeja'],
            'idmenu' => $data['idmenu'],
            'jumlah' => $data['jumlah'],
            'iduser' => $request->user()->iduser,
        ]);

        Meja::where('idmeja', $data['idmeja'])->update(['status' => 'tidak_tersedia']);

        return redirect()->route('pesanan.index')->with('success', 'Pesanan berhasil dicatat.');
    }
}
