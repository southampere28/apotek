<?php

namespace App\Models;

use App\Models\PembelianDetail;
use App\Models\PenjualanDetail;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    use HasFactory;

    protected $table = 'obat';

    protected $fillable = [
        'kode_obat',
        'nama_obat',
        'gambar_obat',
        'jenis',
        'harga_beli',
        'harga_jual',
        'stok',
        'tanggal_kadaluarsa',
        'supplier_id',
    ];

    protected function casts(): array
    {
        return [
            'harga_beli' => 'integer',
            'harga_jual' => 'integer',
            'stok' => 'integer',
            'tanggal_kadaluarsa' => 'date',
        ];
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function pembelianDetail(): HasMany
    {
        return $this->hasMany(PembelianDetail::class);
    }

    public function penjualanDetail(): HasMany
    {
        return $this->hasMany(PenjualanDetail::class);
    }
}