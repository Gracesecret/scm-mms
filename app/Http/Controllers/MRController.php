<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Materialmasuk;
use App\Models\Materialmr;
use App\Models\Materialrequisition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class MRController extends Controller
{
    public function listmr()
    {
        $badge = Materialrequisition::all();
        $data = Materialrequisition::orderBy('id','desc')->get();
        return view('mr.list-mr',compact(['data','badge']));
        # code...
    }
    public function pendingmr()
    {
        $badge = Materialrequisition::all();
        $data = Materialrequisition::where('status','pending')->orderBy('id','desc')->get();
        return view('mr.pending-mr',compact(['data','badge']));
        # code...
    }
    public function approvedmr()
    {
        $badge = Materialrequisition::all();
        $data = Materialrequisition::where('status','released')->orderBy('id','desc')->get();
        return view('mr.approved-mr',compact(['data','badge']));
        # code...
    }
    public function hapusmr($id)
    {
        Materialrequisition::findOrFail($id)->delete();
        return back();
        # code...
    }
    public function formadd()
    {
        $userid = auth()->user()->dept->id;
        $material = Material::where('dept_id',$userid)->get();
        $mr = Materialrequisition::count();
        $date = Carbon::now()->format('Ym');
        $nomr = 'MR-0'.$date.$mr +=1 ;

        return view('mr.add-mr',compact(['material','nomr','userid']));
        # code...
    }
    public function simpanmr(Request $request)
    {
        $userid = auth()->user()->dept->id;
        $insertmr = new Materialrequisition;
        $insertmr->no_mr = $request->no_mr;
        $insertmr->dept_id = $userid;
        $insertmr->status = 'pending';
        $insertmr->save();
        // dd($insertmr);

        $mr_id = $insertmr->id;
        $mrid = $request->mr;
        $barang_id = $request->barangid;
        $qty = $request->input('qtyreq');
 
        for($i=0; $i<count($mrid); $i++)
        {
            $datamr = new Materialmr;
            $datamr->materialrequisition_id = $mrid[$i] = $mr_id;
            $datamr->material_id = $barang_id[$i];
            $datamr->qty_req = $qty[$i];
            $datamr->save();
        }

        return redirect(route('mr.print', ['id' => $insertmr->id]));

        # code...
    }
    public function prosesmr($id)
    {
        $data = Materialmr::whereHas('materialrequisition', function($q) use ($id){
            $q->where('materialrequisition_id',$id);
        })->get();
        $mr = Materialrequisition::findOrFail($id);
        return view('mr.proses-mr',compact(['data','mr']));
        # code...
    }
    public function simpaneditmr(Request $request)
    {
        $date[] = Carbon::now();
        $idreq = $request->input('material_id');
        $idbrg = $request->input('material_mr');
        $qty = $request->input('qty_approve');
        $userid = $request->input('user_id');

        $updatestatus = Materialrequisition::findOrFail($request->id_mr);
        $updatestatus->status = 'released';
        $updatestatus->save();

        for($i=0; $i<count($idreq); $i++)
        {
        DB::table('materialmr')
                ->where(array('id' => $idbrg[$i]))
                ->update(array('qty_approve' => $qty[$i]
                ));
        }
        for($i=0; $i<count($idreq); $i++)
        {
            $materialmasuk = new Materialmasuk;
            $materialmasuk->material_id = $idreq[$i];
            $materialmasuk->dept_id = $userid[$i];
            $materialmasuk->qty = $qty[$i];
            $materialmasuk->save();
        }
        for($i=0; $i<count($idreq); $i++)
        {
            $updatestok = Material::find($idreq[$i]);
            $updatestok->stok_main -= $qty[$i];
            $updatestok->stok_sub += $qty[$i];
            $updatestok->save();
        }
        return redirect(route('list-mr'));
        # code...
    }
    public function printmr($id)
    {
        $data = Materialmr::whereHas('materialrequisition', function($q) use($id) {
            $q->where('materialrequisition_id','=', $id);
        })->get();
        $mr = Materialrequisition::find($id);
        $pdf = \PDF::loadView('pdf.printmr',compact(['data','mr']));
        return $pdf->stream();
        # code...
    }
    public function detailmr($id)
    {
        $data = Materialmr::whereHas('materialrequisition', function($q) use($id) {
            $q->where('materialrequisition_id','=', $id);
        })->get();
        $mr = Materialrequisition::find($id);

        return view('mr.detail-mr',compact(['data','mr']));        
        # code...
    }
    //
}
