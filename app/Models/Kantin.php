<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kantin extends Model
{
    use HasFactory;

    protected $table = 'kantins';
    protected $primaryKey = 'id_kantin';

    protected $fillable = [
        'id_admin',
        'nama_kantin'
    ];

}
