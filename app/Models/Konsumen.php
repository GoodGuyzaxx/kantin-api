<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Konsumen extends Authenticatable
{
    use HasFactory,Notifiable;

    protected $table = 'konsumens';
    protected $primaryKey = 'id_konsumen';
    protected $fillable = [
      'nama_konsumen',
      'email',
      'password',
        'no_telp'
    ];

    protected $hidden = [
        'password'
    ];

    public function user()
    {
        return$this->belongsTo(User::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class);
    }
}
