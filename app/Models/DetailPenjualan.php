<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailPenjualan extends Model
{
    protected $table = 'detail_penjualan';
    protected $primaryKey = 'id_transaksi_detail';
    protected $fillable = ['id_transaksi', 'id_barang', 'jml_barang', 'harga_satuan'];

    public function penjualanRelasi(){
        return $this->belongsTo(Penjualan::class, 'id_transaksi', 'id_transaksi');
    }

    public function barangRelasi(){
        return $this->belongsTo(Barang::class, 'id_barang', 'id_barang');
    }

    public function hitungSubtotal()
    {
        return $this->jml_barang * $this->harga_satuan;
    }
}
