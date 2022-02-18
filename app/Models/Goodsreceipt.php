<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Goodsreceipt extends Model
{
    use HasFactory;
    protected $table = 'goodsreceipt';
    protected $fillable = ['grnumber_id','materialprpo_id','qty_masuk','qty_retur'];

    public function materialprpo()
    {
        return $this->belongsTo(Materialprpo::class);
        # code...
    }
    public function grnumber()
    {
        # code...
        return $this->belongsTo(Grnumber::class);
    }
}
