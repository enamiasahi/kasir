<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $primaryKey = 'idpelanggan';
    protected $fillable = [
        'namapelanggan',
        'is_man',
        'nohp',
        'alamat',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'idpelanggan', 'idpelanggan');
    }
}
