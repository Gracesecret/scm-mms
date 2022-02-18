<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaseorder extends Model
{
    use HasFactory;

    protected $table = 'purchaseorder';

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
        # code...
    }
}
