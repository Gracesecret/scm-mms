<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Dept;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function listuser()
    {
        $dept = Dept::all();
        $data = User::all();
        return view('admin.list-user',compact(['data','dept']));
        # code...
    }
    public function listdept()
    {
        $data = Dept::all();
        return view('admin.list-dept',compact(['data']));
        # code...
    }
    public function listbudget()
    {
        $data = Budget::all();
        return view('admin.list-budget',compact(['data']));
        # code...
    }
    public function updatebudget(Request $request,$id)
    {
        $budget = Budget::findOrFail($id);
        $budget->update([
            'budget' => $request->budget,
            'request' => 0]);
        return back();
        # code...
    }
    public function requestbudget(Request $request, $id)
    {
        $budget = Budget::findOrFail($id);
        $budget->update(
            ['request' => $request->req]
        );
        return back();
        # code...
    }

    protected function create(Request $request)
    {
        $Validator = Validator::make($request->all(), [
            'username' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);        
        $user = new User;
        $user->username = $request->username;
        $user->role = $request->role;
        $user->dept_id = $request->dept;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->back();
    }
    public function hapususer($id)
    {
        User::findOrFail($id)->delete();
        return redirect(route('list-user'));

        # code...
    }
    public function tambahdept(Request $request)
    {
        $dept = new Dept;
        $dept->kode = $request->kode;
        $dept->departement = $request->dept;
        $dept->save();
        return redirect()->back()->with('success','Data Berhasil ditambahkan');
        # code...
    }
    public function edituser(Request $request, $id)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
            'dept' => 'required'
        ]);
        $user = User::findOrFail($id);
        $user->update([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'dept_id' => $request->dept
        ]);

        Alert::success('Data Berhasil diubah');
        return back();
        # code...
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
