<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pesanan;
use App\Models\Transaksi;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $awal = $request->input('awal', now()->startOfMonth()->toDateString());
        $akhir = $request->input('akhir', now()->endOfMonth()->toDateString());

        $user = $request->user();
        
        // Pengecekan role yang aman (Spatie / Role biasa)
        $isWaiter = method_exists($user, 'hasRole') ? $user->hasRole('waiter') : ($user->role === 'waiter');

        if ($isWaiter) {
            // Gunakan DB::raw untuk fungsi DATE() & simpan ke variabel $pesanan
            $pesanan = Pesanan::with(['pelanggan', 'meja', 'menu'])
                ->whereHas('transaksi')
                ->whereBetween(DB::raw('DATE(created_at)'), [$awal, $akhir])
                ->get();

            $jenis = 'pesanan';
            $total = $pesanan->sum(function ($p) {
                return $p->jumlah * ($p->menu->harga ?? 0);
            });
        } else {
            // Simpan ke variabel $pesanan agar konsisten dengan Blade
            $pesanan = Transaksi::with(['pesanan.pelanggan', 'pesanan.meja', 'pesanan.menu'])
                ->whereBetween(DB::raw('DATE(created_at)'), [$awal, $akhir])
                ->get();

            $jenis = 'transaksi';
            $total = $pesanan->sum('total');
        }

        // Kirim $pesanan ke view (bukan $data)
        return view('laporan.index', compact('pesanan', 'awal', 'akhir', 'jenis', 'total'));
    }
}