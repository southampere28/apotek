<?php

namespace App\Models;

use App\Models\Obat;
use App\Models\Pembelian;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    use HasFactory;

    protected $table = 'supplier';

    protected $fillable = [
        'kode_supplier',
        'nama',
        'alamat',
        'kota',
        'telepon',
    ];

    public function obat(): HasMany
    {
        return $this->hasMany(Obat::class);
    }

    public function pembelian(): HasMany
    {
        return $this->hasMany(Pembelian::class);
    }
}