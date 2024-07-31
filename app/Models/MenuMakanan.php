<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuMakanan extends Model
{
    use HasFactory;

    //Mengijikin tabel yang di isi
    protected $fillable = [
        'nama_menu',
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
