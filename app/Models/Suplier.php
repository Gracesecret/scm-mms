<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suplier extends Model
{
    use HasFactory;

    protected $table = 'suplier';
    protected $fillable = ['nama_agen','nama_cv','alamat','telp','telp_agen','email'];

    public function material()
    {
        return $this->belongsTo(Material::class);
        # code...
    }
    public function purchaseorder()
    {
        return $this->belongsTo(Purchaseorder::class);
        # code...
    }
}
