<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Materialprpo;
use App\Models\Purchaserequisition;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PRController extends Controller
{
    public function listpr()
    {
        $badge = Purchaserequisition::all();
        $data = Purchaserequisition::orderBy('id','desc')->get();
        return view('pr.list-pr',compact(['data','badge']));
        # code...
    }
    public function pendingpr()
    {
        $badge = Purchaserequisition::all();
        $data = Purchaserequisition::where('status','pending')->orderBy('id','desc')->get();
        return view('pr.pending-pr',compact(['data','badge']));
        # code...
    }
    public function approvedpr()
    {
        $badge = Purchaserequisition::all();
        $data = Purchaserequisition::where('status','approved')->orderBy('id','desc')->get();
        return view('pr.approved-pr',compact(['data','badge']));
        # code...
    }
    public function formadd()
    {
        $userid = auth()->user()->dept->id;
        $material = Material::where('dept_id',$userid)->get();
        $pr = Purchaserequisition::count();
        $date = Carbon::now()->format('Ym');
        $nopr = 'PR-0'.$date.$pr +=1 ;

        return view('pr.add-pr',compact(['material','nopr','userid']));        
        # code...
    }
    public function createpr(Request $request)
    {
        $insertpr = new Purchaserequisition;
        $insertpr->no_pr = $request->no_pr;
        $insertpr->dept_id = $request->user_id;
        $insertpr->status = 'pending';
        $insertpr->save();
        // dd($insertpr);

        $pr_id = $insertpr->id;
        $prid = $request->pr;
        $userid = $request->userid;
        $barang_id = $request->barangid;
        $status = $request->statusmaterial;
        $rate = $request->harga;
        $qty = $request->input('qtyreq');
 
        for($i=0; $i<count($prid); $i++)
        {
            $datapr = new Materialprpo();
            $datapr->purchaserequisition_id = $prid[$i] = $pr_id;
            $datapr->material_id = $barang_id[$i];
            $datapr->qty_pr = $qty[$i];
            $datapr->status = $status[$i];
            $datapr->dept_id = $userid[$i];
            $datapr->val_pr = $qty[$i] *= $rate[$i]; 
            $datapr->save();
        }

        return redirect(route('pr.print', ['id' => $insertpr->id]));

        # code...
    }
    public function prosespr($id)
    {
        $data = Materialprpo::whereHas('purchaserequisition', function($q) use($id) {
            $q->where('purchaserequisition_id','=', $id);
        })->get();
        $pr = Purchaserequisition::find($id);
        $rate = Materialprpo::whereHas('purchaserequisition', function($q) use($id) {
            $q->where('purchaserequisition_id','=', $id);
        })->selectRaw('sum(val_pr) as sum')->pluck('sum')->first();

        return view('pr.proses-pr',compact(['data','pr','rate']));
        # code...
    }
    public function simpanprosespr(Request $request)
    {
        $materialpr_id = $request->material_id;
        $qty = $request->qty_po;
        $statusbarang = $request->status;

        $updatestatus = Purchaserequisition::findOrFail($request->pr_id);
        $updatestatus->status = $request->statuspr;
        $updatestatus->save();

        for($i=0; $i<count($materialpr_id); $i++)
        {
        DB::table('materialprpo')
                ->where(array('id' => $materialpr_id[$i]))
                ->update(array(
                    'qty_po' => $qty[$i],
                    'status' => $statusbarang[$i],
                ));
        }
        return redirect(route('detail-pr',$request->pr_id));        
        # code...
    }
    public function detailpr($id)
    {
        $data = Materialprpo::whereHas('purchaserequisition', function($q) use($id) {
            $q->where('purchaserequisition_id','=', $id);
        })->get();
        $pr = Purchaserequisition::find($id);
        $rate = Materialprpo::whereHas('purchaserequisition', function($q) use($id) {
            $q->where('purchaserequisition_id','=', $id);
        })->selectRaw('sum(val_pr) as sum')->pluck('sum')->first();

        return view('pr.detail-pr',compact(['data','pr','rate']));
        # code...
    }
    public function printpr($id)
    {
        $data = Materialprpo::whereHas('purchaserequisition', function($q) use($id) {
            $q->where('purchaserequisition_id','=', $id);
        })->get();
        $pr = Purchaserequisition::find($id);
        $rate = Materialprpo::whereHas('purchaserequisition', function($q) use($id) {
            $q->where('purchaserequisition_id','=', $id);
        })->selectRaw('sum(val_pr) as sum')->pluck('sum')->first();
        $pdf = \PDF::loadView('pdf.printpr',compact(['data','pr','rate']));
        return $pdf->stream();
        # code...
    }
    public function hapuspr($id)
    {
        Purchaserequisition::findOrFail($id)->delete();
        Materialprpo::where('purchaserequisition_id',$id)->delete();
        return redirect(route('list-pr'));
        # code...
    }
    //
}
