<?php

namespace App\Http\Controllers;

use App\Models\Goodsreceipt;
use App\Models\Material;
use App\Models\Materialprpo;
use App\Models\Purchaseorder;
use App\Models\Suplier;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class POController extends Controller
{

    public function listpo()
    {
        $badge = Purchaseorder::all();
        $data = Purchaseorder::orderBy('id','desc')->get();
        $suplier = Suplier::orderBy('id','asc')->get();

        return view('po.list-po',compact(['data','badge','suplier']));
        # code...
    }
    public function pendingpo()
    {
        $badge = Purchaseorder::all();
        $data = Purchaseorder::where('status','pending')->orderBy('id','desc')->get();
        $suplier = Suplier::all();

        return view('po.pending-po',compact(['data','badge','suplier']));
        # code...
    }
    public function receivedpo()
    {
        $badge = Purchaseorder::all();
        $data = Purchaseorder::where('status','Completed')->orderBy('id','desc')->get();
        $suplier = Suplier::all();

        return view('po.received-po',compact(['data','badge','suplier']));
        # code...
    }
    public function addpobypr($id)
    {
        $suplier = Suplier::findOrFail($id);
        $data = Materialprpo::whereHas('material', function($q) use($id){
            $q->where('suplier_id',$id)
            ->where('status','=','Approved');
        })->get();
        $x = Purchaseorder::count();
        $date = Carbon::now()->format('Ym');
        $nopo = 'PO-0'.$date.$x += 1;
        return view('po.add-pobypr',compact(['data','nopo','suplier']));
        # code...
    }
    public function addpo($id)
    {
        
        $suplier = Suplier::findOrFail($id);
        $data = Material::whereHas('suplier', function($q) use($id){
            $q->where('suplier_id',$id);
        })->get();
        $x = Purchaseorder::count();
        $date = Carbon::now()->format('Ym');
        $nopo = 'PO-0'.$date.$x += 1;
        return view('po.add-po',compact(['data','nopo','suplier']));
        # code...
    }
    public function savepo(Request $request)
    {
        $x = Purchaseorder::count();
        $date = Carbon::now()->format('Ym');
        $nopo = 'PO-0'.$date.$x += 1;

        $request->validate([
            'barangid' => 'required'
            ]);
        $insertpo = new Purchaseorder;
        $insertpo->status = 'pending';
        $insertpo->suplier_id = $request->suplier_id;
        $insertpo->no_po = $nopo;
        $insertpo->save();

        $po_id = $insertpo->id;
        $prid = $request->pr;
        $barang_id = $request->barangid;
        $status = $request->statusmaterial;
        $rate = $request->harga;
        $qty = $request->input('qtyreq');
 
        for($i=0; $i<count($prid); $i++)
        {
            $datapr = new Materialprpo();
            $datapr->purchaseorder_id = $prid[$i] = $po_id;
            $datapr->material_id = $barang_id[$i];
            $datapr->qty_po = $qty[$i];
            $datapr->status = $status[$i];
            $datapr->val_po = $qty[$i] *= $rate[$i]; 
            $datapr->save();
        }

        return redirect(route('print-po', ['id' => $po_id]));
        # code...
    }
    public function savepobypr(Request $request)
    {
        $x = Purchaseorder::count();
        $date = Carbon::now()->format('Ym');
        $nopo = 'PO-0'.$date.$x += 1;

        $insertpo = new Purchaseorder;
        $insertpo->status = 'pending';
        $insertpo->suplier_id = $request->suplier_id;
        $insertpo->no_po = $nopo;
        $insertpo->save();

        $po_id = $insertpo->id;
        $poid = $request->pr;
        $barang_id = $request->barangid;
        $materialpr = $request->materialpo;
        $status = $request->statusmaterial;
        $rate = $request->harga;
        $qty = $request->qtyreq;
 
        for($i=0; $i<count($poid); $i++)
        {
            $datapr = Materialprpo::findOrFail($materialpr[$i]);
            $datapr->purchaseorder_id = $poid[$i] = $po_id;
            $datapr->material_id = $barang_id[$i];
            $datapr->qty_po = $qty[$i];
            $datapr->status = $status[$i];
            $datapr->val_po = $qty[$i] *= $rate[$i]; 
            $datapr->save();
        }

        return redirect(route('print-po', ['id' => $po_id]));
        # code...        
        # code...
    }
    public function detailpo($id)
    {
        $data = Materialprpo::whereHas('purchaseorder', function($q) use($id) {
            $q->where('purchaseorder_id','=', $id);
        })->get();
        $po = Purchaseorder::find($id);
        $rate = Materialprpo::whereHas('purchaseorder', function($q) use($id) {
            $q->where('purchaseorder_id','=', $id);
        })->selectRaw('sum(val_po) as sum')->pluck('sum')->first();
        $tax = $rate * 10/100;
        $total = $rate + $tax;

        return view('po.detail-po',compact(['data','po','rate','tax','total']));
        # code...
    }
    public function prosespo($id)
    {
        $data = Materialprpo::whereHas('purchaseorder', function($q) use($id) {
            $q->where('purchaseorder_id','=', $id);
        })->get();
        $po = Purchaseorder::find($id);
        $rate = Materialprpo::whereHas('purchaseorder', function($q) use($id) {
            $q->where('purchaseorder_id','=', $id);
        })->selectRaw('sum(val_po) as sum')->pluck('sum')->first();

        return view('po.proses-po',compact(['data','po','rate']));        

        # code...
    }
    public function simpanprosespo(Request $request)
    {
        $materialpr_id = $request->material_id;
        $qtyreceived = $request->qty_rec;
        // $qtypo = $request->qtypo;
        $qtysem = $request->qtysementara;
        $statusbarang = $request->status;
        $idmaterial = $request->materialid;

        $updatestatus = Purchaseorder::findOrFail($request->po_id);
        $updatestatus->status = $request->statuspr;
        $updatestatus->save();

        for($i=0; $i<count($materialpr_id); $i++)
        {
            $updatepo = Materialprpo::findOrFail($materialpr_id[$i]);
            $updatepo->qty_received = $qtysem[$i] += $qtyreceived[$i];
            // $updatepo->qty_pending = $qtypo[$i] -= $qtysem[$i] += $qtyreceived[$i];
            $updatepo->status = $statusbarang[$i];
            $updatepo->save();
        }
        return redirect(route('list-po'));        
        # code...
    }
    public function printpo($id)
    {
        $data = Materialprpo::whereHas('purchaseorder', function($q) use($id) {
            $q->where('purchaseorder_id','=', $id);
        })->get();
        $po = Purchaseorder::find($id);
        $rate = Materialprpo::whereHas('purchaseorder', function($q) use($id) {
            $q->where('purchaseorder_id','=', $id);
        })->selectRaw('sum(val_po) as sum')->pluck('sum')->first();
        $tax = $rate * 10/100;
        $total = $rate + $tax;
        $pdf = \PDF::loadView('pdf.printpo',compact(['data','po','rate','total','tax']))
        ->setPaper('a4','landscape');
        return $pdf->stream('pdf.printpo.pdf');   
        # code...
    }
    //
}
