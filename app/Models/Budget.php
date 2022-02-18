<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
    use HasFactory;
    protected $table = 'budget';
    protected $fillable = ['budget','request'];

    public function dept()
    {
        return $this->belongsTo(Dept::class);
        # code...
    }
}
