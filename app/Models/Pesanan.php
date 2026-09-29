<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanans';
    protected $primaryKey = 'idpesanan';
    protected $fillable = [
        'idpelanggan',
        'iduser',
        'idmeja',
    ];

    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'idpelanggan', 'idpelanggan');
    }

    public function meja()
    {
        return $this->belongsTo(Meja::class, 'idmeja', 'idmeja');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'iduser', 'id');
    }
    public function getTotalAttribute()
    {
        return $this->detail->sum(function ($detail) {
            return $detail->jumlah * $detail->menu->harga;
        });
    }
    public function transaksi()
    {
        return $this->hasOne(Transaksi::class, 'idpesanan', 'idpesanan');
    }

    public function getSudahDibayarAttribute()
    {
        return $this->transaksi()->exists();
    }

    public function detail()
    {
        return $this->hasMany(DetailPesanan::class, 'idpesanan', 'idpesanan');
    }
}
