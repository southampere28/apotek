<?php

namespace App\Models;

use App\Models\Pelanggan;
use App\Models\PenjualanDetail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penjualan extends Model
{
    use HasFactory;

    protected $table = 'penjualan';

    protected $fillable = [
        'nota',
        'tanggal_nota',
        'pelanggan_id',
        'diskon',
        'subtotal',
        'total_harga',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_nota' => 'datetime',
            'diskon' => 'integer',
            'subtotal' => 'integer',
            'total_harga' => 'integer',
        ];
    }

    public function pelanggan(): BelongsTo
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function detail(): HasMany
    {
        return $this->hasMany(PenjualanDetail::class);
    }
}