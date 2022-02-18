<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OcraController extends Controller
{
    public function index()
    {
        $data = Material::where('dept_id',auth()->user()->dept->id)->get();

        $max = Material::select('pengiriman','stok_sub','harga',
        DB::raw('MAX(pengiriman) AS pengiriman'),
        DB::raw('MAX(harga) AS harga'),
        DB::raw('MAX(stok_sub) AS stok_sub'))
        ->where('dept_id',auth()->user()->dept->id)
               ->get();
        $min = Material::select('pengiriman','stok_sub','harga',
        DB::raw('MIN(pengiriman) AS pengiriman'),
        DB::raw('MIN(harga) AS harga'),
        DB::raw('MIN(stok_sub) AS stok_sub'))
        ->where('dept_id',auth()->user()->dept->id)
               ->get();
        $bobotp[] = 0.40;
        $bobots[] = 0.30;
        $boboth[] = 0.30;
        $bobotpengiriman = 0.40;
        $bobotstok_sub = 0.30;
        $bobotharga = 0.30;
        foreach($data as $i)
        foreach($max as $mx){
            $prefpengiriman[] = $bobotpengiriman*($mx->pengiriman-$i->pengiriman)/$i->pengiriman;
            $prefstok[] = $bobotstok_sub*($mx->stok_sub-$i->stok_sub)/$i->stok_sub;
            $prefharga[] = $bobotharga*($mx->harga-$i->harga)/$i->harga;
        }
        $total = $prefpengiriman+$prefstok+$prefharga;

        $datafinal =[];
        $minimal =[];
        foreach($data as $q){
            foreach($max as $mx){
                foreach($min as $mn){
                    foreach($bobotp as $bp){
                        foreach($bobots as $bs){
                            foreach($boboth as $bh){
                                $datafinal[]=[
                                    'desc' => $q->description,
                                    'pengiriman' => $bp * ($mx->pengiriman-$q->pengiriman)/$mn->pengiriman,
                                    'stok_sub' => $bs * ($mx->stok_sub-$q->stok_sub)/$mn->stok_sub,
                                    'harga' => $bh * ($mx->harga-$q->harga)/$mn->harga,
                                    'total' => $bp * ($mx->pengiriman-$q->pengiriman)/$mn->pengiriman+
                                    $bs * ($mx->stok_sub-$q->stok_sub)/$mn->stok_sub+
                                    $bh * ($mx->harga-$q->harga)/$mn->harga
                                ];
                                $minimal[] = [
                                $bp * ($mx->pengiriman-$q->pengiriman)/$mn->pengiriman+
                                $bs * ($mx->stok_sub-$q->stok_sub)/$mn->stok_sub+
                                $bh * ($mx->harga-$q->harga)/$mn->harga];
                            }
                        }
                    }
                }
            }
        }
        $minpref = min($minimal);
        return view('ocra.metode',compact(['data','max','min','bobotp','bobots','boboth'
        ,'datafinal','minpref']));
        # code...
    }
    //
}
