<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Materialkeluar;
use App\Models\Materialmasuk;
use App\Models\Materialprpo;
use App\Models\Suplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class MaterialController extends Controller
{
    public function listmaterial()
    {
        $userid = auth()->user()->dept->id;
        $main = Material::all();
        $data = Material::where('dept_id',$userid)->orderBy('id','desc')->get();
        return view('material.material',compact(['data','main']));
        # code...
    }
    public function viewaddmaterial()
    {
        $suplier = Suplier::all();
        return view('material.tambah-material',compact(['suplier']));
        # code...
    }
    public function create(Request $request)
    {

        $messages = [
            'required' => 'Kolom Wajib terisi',
            'min' => ':kolom harus diisi minimal :min karakter!!!',
            'max' => ':kolom harus diisi maksimal :max karakter!!!',
            'unique' => 'sudah ada nama yang sama',
        ];
        $request->validate([
            'partcode' => 'required|min:5|unique:material',
            'description' => 'required|min:5|unique:material',
            'satuan' => 'required',
            'file' => 'image|max:1024',
        ],$messages);
        $file = $request->file('file');
		$gambar = time()."_".$file->getClientOriginalName();
      	        // isi dengan nama folder tempat kemana file diupload
		$tujuan_upload = 'data_file';
		$file->move($tujuan_upload,$gambar);
		Material::create([
			'foto' => $gambar,
			'partcode' => $request->partcode,
			'description' => $request->description,
			'satuan' => $request->satuan,
			'harga' => $request->harga,
			'stok_main' => $request->stok_main,
			'minimal_stok' => $request->minimal_stok,
            'suplier_id' => $request->suplier_id,
            'dept_id' => auth()->user()->dept->id,
        ]);
        
        Alert::success('Data Berhasil Disimpan!');
		return back();
        # code...
    }
    public function update(Request $request, $id)
    {
        $messages = [
            'required' => 'Kolom Wajib terisi',
            'min' => 'Update kolom harus diisi minimal :min karakter!!!',
            'max' => 'Update kolom harus diisi maksimal :max karakter!!!',
        ];        
        $request->validate([
            'partcode' => 'required|min:5',
            'description' => 'required|min:5',
            'minimal_stok' => 'required',
            'harga' => 'required|min:4',
        ],$messages);
        $update = Material::findOrFail($id);
        $update->update($request->all());

        Alert::success('Data Berhasil Diubah');
        return back();        
        # code...
    }
    public function delete($id)
    {
        Material::findOrFail($id)->delete();
        return back();
        # code...
    }
    public function detailmaterial($id)
    {
        $data = Material::findOrFail($id);
        return view('material.detail-material',compact(['data']));
        # code...
    }
    public function materialkeluar($id)
    {
        $data = Material::findOrFail($id);
        return view('material.material-keluar',compact(['data']));
        # code...
    }
    public function simpankeluar(Request $request)
    {
        $userid = auth()->user()->dept->id;
        $simpan = new Materialkeluar;
        $simpan->material_id = $request->material_id;
        $simpan->dept_id = $userid;
        $simpan->nama = $request->nama;
        $simpan->qty = $request->jumlah;
        $simpan->sub_total = $request->harga *= $request->jumlah;
        $simpan->tanggal = $request->tanggal;
        $simpan->note = $request->note;
        $simpan->save();
        
        $material = Material::findOrFail($request->material_id);
        $material->stok_sub -= $request->jumlah;
        $material->save();

        Alert::success('Data Berhasil Disimpan!');
        return back();
        # code...
    }
    public function listmaterialkeluar()
    {
        $data = Materialkeluar::where('dept_id',auth()->user()->dept->id)
        ->orderBy('tanggal','desc')->get();
        return view('material.list-keluar',compact(['data']));
        # code...
    }
    public function minstok()
    {
        $data = Material::where('dept_id',auth()->user()->dept->id)
        ->whereRaw('stok_sub < minimal_stok')->get();

        return view('material.minstok',compact(['data']));
        # code...
    }
    public function listmaterialmasuk()
    {
        $data = Materialmasuk::where('dept_id',auth()->user()->dept->id)
        ->orderBy('created_at','desc')->get();
        return view('material.list-masuk',compact(['data']));        
        # code...
    }
    public function searchbetweenkeluar(Request $request)
    {
        $data = Materialkeluar::where('tanggal','>=',$request->from)->where('tanggal','<=',$request->to)
        ->where('dept_id',auth()->user()->dept->id)
        ->get();
        return view('material.list-keluar',compact(['data']));
        # code...
    }
    public function searchbetweenmasuk(Request $request)
    {
        $data = Materialmasuk::where('created_at','>=',$request->from)->where('created_at','<=',$request->to)
        ->where('dept_id',auth()->user()->dept->id)
        ->get();
        return view('material.list-masuk',compact(['data']));
        # code...
    }
    public function listprpo()
    {
        $data = Materialprpo::select('material_id','purchaserequisition_id','purchaseorder_id',
        DB::raw('MAX(purchaserequisition_id) AS purchaserequisition_id'),
        DB::raw('MAX(purchaseorder_id) AS purchaseorder_id'))
        ->where('dept_id',auth()->user()->dept->id)
               ->groupby('material_id')
               ->get();

       return view('material.prpo',compact(['data']));
        # code...
    }
    public function historykeluar($id)
    {        
        $data2 = Materialkeluar::whereHas('material', function($q) use ($id) {
        $q->where('material_id','=', $id);
        })->orderBy('tanggal', 'DESC')->paginate(5);
        $sumtotal = Materialkeluar::whereHas('material', function($q) use ($id) {
        $q->where('material_id','=', $id);
        })->sum('sub_total');
        $data = Material::findOrFail($id);

        return view('material.history-keluar',compact(['data','data2','sumtotal']));
        # code...
    }
    public function historyprpo($id)
    {
        $datapr = Materialprpo::whereHas('purchaserequisition', function($q) use($id){
            $q->where('material_id',$id);
        })->get();
        $datapo = Materialprpo::whereHas('purchaseorder', function($q) use($id){
            $q->where('material_id',$id);
        })->get();
        return view('material.historyprpo',compact(['datapr','datapo']));
        # code...
    }
    //
}
