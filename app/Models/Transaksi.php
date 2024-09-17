<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
      'id-order',
      'id-kantin',
      'total-harga',
      'tipe-pembayaran',
      'status-pembayaran'
    ];
}
