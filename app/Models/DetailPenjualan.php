<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detailpenjualan';

    protected $primaryKey = 'id_detail';

    protected $fillable = [
        'id_penjualan', 'id_produk', 'jumlah_produk', 'subtotal'
    ];

    public function produk()
{
    return $this->belongsTo(Produk::class, 'id_produk', 'id_produk');
}
}
