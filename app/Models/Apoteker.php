<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Apoteker extends Model
{
    use HasFactory;

    protected $table = 'apoteker';

    protected $fillable = [
        'kode_apoteker',
        'user_id',
        'nama',
        'alamat',
        'kota',
        'telepon',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}