<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialrequisition extends Model
{
    use HasFactory;
    protected $table = 'materialrequisition';

    public function materialmr()
    {
        return $this->belongsTo(Materialmr::class);
        # code...
    }
    public function dept()
    {
        return $this->belongsTo(Dept::class);
        # code...
    }
}
