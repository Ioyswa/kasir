<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // Menggunakan kelas dasar Authenticatable
use Illuminate\Notifications\Notifiable;

class Operator extends Authenticatable // Mengubah kelas dasar menjadi Authenticatable
{

    protected $table = 'operator';

    protected $primaryKey = 'id';

    protected $fillable = [
        'username', 'password'
    ];

    protected $hidden = [
        'password',
    ];
}
