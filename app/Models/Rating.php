<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_konsumen',
        'id_makanan',
        'id_minuman',
        'rating'
    ];

    protected $casts = [
        'rating' => 'int'
    ];
}
