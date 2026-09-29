<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'menus';
    protected $primaryKey = 'idmenu';
    protected $fillable = [
        'namamenu',
        'harga',
    ];

    public function pesanans()
    {
        return $this->hasMany(Pesanan::class, 'idmenu', 'idmenu');
    }
}
