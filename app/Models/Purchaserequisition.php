<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchaserequisition extends Model
{
    use HasFactory;
    protected $table = 'purchaserequisition';

    public function materialprpo()
    {
        return $this->belongsTo(Materialprpo::class);
        # code...
    }
}
