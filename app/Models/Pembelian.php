<?php

namespace App\Models;

use App\Models\PembelianDetail;
use App\Models\Supplier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pembelian extends Model
{
    use HasFactory;

    protected $table = 'pembelian';

    protected $fillable = [
        'nota',
        'tanggal_nota',
        'supplier_id',
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

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function detail(): HasMany
    {
        return $this->hasMany(PembelianDetail::class);
    }
}