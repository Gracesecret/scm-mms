<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suplier;
use RealRashid\SweetAlert\Facades\Alert;

class SuplierController extends Controller
{
    public function listsuplier()
    {
        $data = Suplier::orderBy('id','desc')->get();
        return view('supplier.list-supplier',compact(['data']));
        # code...
    }
    public function viewaddsupplier()
    {
        return view('supplier.tambah-supplier');
        # code...
    }
    public function create(Request $request)
    {
        $messages = [
            'required' => 'Kolom Wajib terisi',
            'min' => ':kolom harus diisi minimal :min karakter!!!',
            'max' => ':kolom harus diisi maksimal :max karakter!!!',
            'unique' => ':sudah ada nama cv yang sama!!!',
        ];
        $request->validate([
            'nama_agen' => 'required|min:5',
            'nama_cv' => 'required|min:5|unique:suplier',
            'telp' => 'required|min:5',
            'telp_agen' => 'required|min:5',
            'email' => 'required|email|min:5',
            'alamat' => 'required|min:10',
        ],$messages);
        $data = $request->all();
        Suplier::create($data); 
        Alert::success('Data Berhasil disimpan!');
        return back();
        # code...
    }
    public function deletesupplier($id)
    {
        Suplier::findOrFail($id)->delete();
        return redirect()->route('list-supplier');
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
            'nama_agen' => 'required|min:5',
            'nama_cv' => 'required|min:5',
            'telp' => 'required|min:5',
            'telp_agen' => 'required|min:5',
            'email' => 'required|email|min:5',
            'alamat' => 'required|min:10',
        ],$messages);
        $update = Suplier::findOrFail($id);
        $update->update($request->all());
        return back();
        # code...
    }
    //
}
