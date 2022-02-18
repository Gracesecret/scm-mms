<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialkeluar extends Model
{
    use HasFactory;
    protected $table = 'materialkeluar';
    protected $fillable = ['material_id','nama','qty','sub_total','note','tanggal'];

    public function material()
    {
        return $this->belongsTo(Material::class);
        # code...
    }
}
