<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_order',
        'id_kantin',
        'total_harga',
        'menu',
        'jumlah',
        'tipe_pembayaran',
        'status_pembayaran',
        'email_konsumen',
        'nama_konsumen'
    ];

    public function kantin(){
        return $this->belongsTo(Kantin::class, 'id_kantin', 'id_kantin');
    }
}
