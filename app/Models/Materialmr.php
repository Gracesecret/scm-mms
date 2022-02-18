<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materialmr extends Model
{
    use HasFactory;
    
    protected $table = 'materialmr';
    protected $fillable = ['material_id','materialrequisition_id','qty_req',
    'qty_approve'];

    public function material()
    {
        return $this->belongsTo(Material::class);
        # code...
    }
    public function materialrequisition()
    {
        return $this->belongsTo(Materialrequisition::class);
        # code...
    }
}
