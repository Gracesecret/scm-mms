<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;
    protected $table = 'material';

    protected $fillable = ['partcode','description','satuan','suplier_id','stok_sub',
    'stok_main','minimal_stok','harga','foto','dept_id'];

    public function suplier()
    {
        return $this->belongsTo(Suplier::class);
        # code...
    }
    public function materialkeluar()
    {
        return $this->belongsTo(Materialkeluar::class);
        # code...
    }
    public function materialmasuk()
    {
        return $this->belongsTo(Materialmasuk::class);
        # code...
    }
    public function materialprpo()
    {
        return $this->belongsTo(Materialprpo::class);
        # code...
    }
    public function dept()
    {
        return $this->belongsTo(Dept::class);
        # code...
    }
    public function value()
    {
        return $this->harga * $this->stok_main;
        # code...
    }
}
