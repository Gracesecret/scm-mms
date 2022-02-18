<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialprpo extends Model
{
    use HasFactory;
    protected $table = 'materialprpo';

    public function material()
    {
        return $this->belongsTo(Material::class);
        # code...
    }
    public function purchaserequisition()
    {
        return $this->belongsTo(Purchaserequisition::class);
        # code...
    }
    public function purchaseorder()
    {
        return $this->belongsTo(Purchaseorder::class);
        # code...
    }
}
