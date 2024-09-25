<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_menu';

    protected $fillable = [
        'id_kantin',
        'nama_menu',
        'deskripsi',
        'harga',
        'gambar',
        'stock',
        'kategori'
    ];

    protected $casts = [
        'harga' => 'float',
        'stock' => 'int'
    ];

    public function ratings()
    {
        return $this->hasMany(Rating::class, 'id_menu'); // 'menu_id' should match your actual foreign key
    }

    public function kantin()
    {
        return $this->belongsTo(Kantin::class, 'id_kantin', 'id_kantin');
    }


}
