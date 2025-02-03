<?php

namespace App\Models;

use App\View\Components\table;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $primaryKey = 'id_pelanggan';

    protected $fillable = [
        'nama_pelanggan', 'alamat', 'nomor_telepon'
    ];
}
