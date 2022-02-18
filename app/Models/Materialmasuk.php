<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialmasuk extends Model
{
    use HasFactory;
    protected $table = 'materialmasuk';
    protected $fillable = ['material_id','qty'];

    public function material()
    {
        return $this->belongsTo(Material::class);
        # code...
    }
}
