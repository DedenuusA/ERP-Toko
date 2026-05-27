<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'unit_id',
        'kode_barang',
        'barcode',
        'nama_barang',
        'harga_beli',
        'harga_jual',
        'stok',
        'minimum_stok',
        'deskripsi',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
