<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    public function index()
    {
        $pesanan = Pesanan::with(['pelanggan', 'meja', 'menu'])
            ->whereDoesntHave('transaksi')
            ->latest()
            ->paginate(10);

        return view('transaksi.index', compact('pesanan'));
    }

    public function store(Request $request, Pesanan $pesanan)
    {
        // Pastikan relasi menu ada sebelum menghitung total
        if (!$pesanan->menu) {
            return redirect()->back()->withErrors(['error' => 'Data menu tidak ditemukan.']);
        }

        $total = $pesanan->menu->harga * $pesanan->jumlah;

        $request->validate([
            'bayar' => 'required|numeric|min:' . $total,
        ], [
            'bayar.min' => 'Jumlah pembayaran tidak mencukupi. Total tagihan: Rp ' . number_format($total, 0, ',', '.'),
        ]);

        $kembalian = $request->bayar - $total;

        DB::transaction(function () use ($request, $pesanan, $total, $kembalian) {
            // 1. Simpan Transaksi
            Transaksi::create([
                'idpesanan' => $pesanan->idpesanan,
                'total'     => $total,
                'bayar'     => $request->bayar,
                'kembalian' => $kembalian,
            ]);

            // 2. Cek apakah masih ada pesanan lain di meja yang sama yang belum dibayar
            if ($pesanan->meja) {
                $masihMenunggu = Pesanan::where('idmeja', $pesanan->idmeja)
                    ->whereDoesntHave('transaksi')
                    ->where('idpesanan', '!=', $pesanan->idpesanan)
                    ->exists();

                // Jika tidak ada pesanan tertunggak lagi, ubah status meja
                if (!$masihMenunggu) {
                    $pesanan->meja->update(['status' => 'tersedia']);
                }
            }
        });

        return redirect()
            ->route('transaksi.struk', ['pesanan' => $pesanan->idpesanan])
            ->with('success', 'Transaksi berhasil diproses.');
    }
}