<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

//    protected $guard = 'user';

    protected $table = "admins";

    protected $primaryKey = 'id_admin';

    protected $fillable = [
        'nama_admin',
        'email',
        'no_telp',
        'password'
    ];

    protected $hidden = [
      'password'
    ];

//    public function user()
//    {
//        return$this->belongsTo(User::class);
//    }
}
