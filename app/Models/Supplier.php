<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'nama',
        'telepon',
        'email',
        'alamat',
        'kota',
        'nama_sales',
    ];
}
