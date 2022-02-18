<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Grnumber extends Model
{
    use HasFactory;
    protected $table = 'grnumber';

    public function goodsreceipt()
    {
        $this->belongsTo(Goodsreceipt::class);
        # code...
    }
}
