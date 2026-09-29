<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'mejas';
    protected $primaryKey = 'idmeja';
    protected $fillable = [
        'nomor_meja',
        'kapasitas',
        'status',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'idmeja', 'idmeja');
    }
}
