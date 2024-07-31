<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMinuman extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_minuman',
        'deskripsi',
        'harga',
        'gambar',
        'stock'
    ];

    protected $casts = [
        'harga' => 'float',
        'stock' => 'int'
    ];
}
