<?php

namespace App\Http\Controllers;

use App\Models\Goodsreceipt;
use App\Models\Grnumber;
use App\Models\Material;
use App\Models\Materialprpo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GRController extends Controller
{
    public function listgr()
    {
        $data = Grnumber::orderBy('id','desc')->get();

        return view('gr.list-gr',compact(['data']));
        # code...
    }
    public function formadd()
    {
        $data = Materialprpo::where('status','received')->get();
        return view('gr.form-add',compact(['data']));
        # code...
    }
    public function simpangr(Request $request)
    {
        $request->validate([
            'materialid' => 'required'
            ]);
        $x = Grnumber::count();
        $date = Carbon::now()->format('Ym');
        $nogr = 'GRN-0'.$date.$x += 1;
        $insertgr = new Grnumber;
        $insertgr->status = $request->statusgr;
        $insertgr->no_gr = $nogr;
        $insertgr->save();

        $materialid = $request->materilid;
        $barang_id = $request->barangid;
        $status = $request->status;
        $retur = $request->qtyretur;
        $grid = $request->gr;
        $qty = $request->input('qtyreq');
 
        for($i=0; $i<count($materialid); $i++)
        {
            $datapr = Materialprpo::findOrFail($materialid[$i]);
            $datapr->qty_retur = $retur[$i]; 
            $datapr->status = $status[$i]; 
            $datapr->save();
        }
        for($i=0; $i<count($materialid); $i++)
        {
            $datapr = new Goodsreceipt;
            $datapr->grnumber_id = $grid[$i] = $insertgr->id; 
            $datapr->materialprpo_id = $materialid[$i];
            $datapr->qty_masuk = $qty[$i];
            $datapr->qty_retur = $retur[$i];
            $datapr->save();
        }
        for($i=0; $i<count($barang_id); $i++)
        {
            $datapr = Material::findOrFail($barang_id[$i]);
            $datapr->stok_main += $qty[$i];
            $datapr->save();
        }

        return redirect(route('detail-gr',$insertgr->id));
        # code...
    }
    public function editgr($id)
    {
        $data = Goodsreceipt::whereHas('grnumber', function($q) use($id){
            $q->where('grnumber_id','=',$id);
        })->get();
        $gr = Grnumber::findOrFail($id);
        return view('gr.edit-gr',compact(['data','gr']));
        # code...
    }
    public function simpaneditgr(Request $request)
    {
        $updategr = Grnumber::findOrFail($request->gr_id);
        $updategr->status = $request->statusgr;
        $updategr->save();

        $grid = $request->grid;
        $qty = $request->qty_received;
        $retur = $request->qty_retur;
        $materialid = $request->material_id;
        $status = $request->status;
        $barang_id = $request->materialid;
        
        for($i=0; $i<count($grid); $i++)
        {
            $datagr = new Goodsreceipt;
            $datagr->grnumber_id = $grid[$i];
            $datagr->materialprpo_id = $materialid[$i];
            $datagr->qty_masuk = $qty[$i];
            $datagr->qty_retur = $retur[$i] -= $qty[$i]; 
            $datagr->save();
        }
        for($i=0; $i<count($materialid); $i++)
        {
            $data = Materialprpo::findOrFail($materialid[$i]);
            $data->qty_retur = $qty[$i] -= $retur[$i]; 
            $data->status = $status[$i];
            $data->save();
        }
        for($i=0; $i<count($barang_id); $i++)
        {
            $datapr = Material::findOrFail($barang_id[$i]);
            $datapr->stok_main += $qty[$i];
            $datapr->save();
        }

        return redirect(route('detail-gr',$grid));
        # code...
    }
    public function detailgr($id)
    {
        $data = Goodsreceipt::whereHas('grnumber', function($q) use($id){
            $q->where('grnumber_id','=',$id);
        })->get();
        $gr = Grnumber::findOrFail($id);
        return view('gr.detail-gr',compact(['data','gr']));
        # code...
    }
    public function printgr($id)
    {
        $data = Goodsreceipt::whereHas('grnumber', function($q) use($id){
            $q->where('grnumber_id','=',$id);
        })->get();
        $gr = Grnumber::findOrFail($id);
        $pdf = \PDF::loadView('pdf.printgr',compact(['data','gr']));
        return $pdf->stream();
        # code...
    }
    //
}
