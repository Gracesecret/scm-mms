<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dept extends Model
{
    use HasFactory;
    protected $table = 'dept';

    public function user()
    {
        return $this->belongsTo(User::class);
        # code...
    }
    public function material()
    {
        return $this->belongsTo(Material::class);
        # code...
    }
    // public function materialrequisition()
    // {
    //     return $this->belongsTo(Materialrequisition::class);
    //     # code...
    // }
}
