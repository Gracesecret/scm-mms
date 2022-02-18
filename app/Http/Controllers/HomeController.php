<?php

namespace App\Http\Controllers;

use App\Models\Budget;
use App\Models\Dept;
use App\Models\Material;
use App\Models\Materialkeluar;
use App\Models\Materialprpo;
use App\Models\Purchaserequisition;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userid = auth()->user()->dept->id;
        $year = Carbon::now();;
        $jmlminstok = Material::where('dept_id',$userid)
        ->whereRaw('stok_sub < minimal_stok')->count();
        $pendingpr = Purchaserequisition::where('dept_id',$userid)
        ->where('status','pending')->count();
        // for($bulan=1;$bulan < 13;$bulan++){
        //     $chart     = collect(DB::SELECT("SELECT sum(sub_total) AS jumlah 
        // from materialkeluar where month(tanggal)='$bulan'"))->first();
        // //     $chartmaterialkeluar[] = $chart->jumlah;
        // //     }
        for($bulan=1;$bulan < 13;$bulan++){
            $chart     = Materialkeluar::where('dept_id',$userid)
            ->
            selectRaw('sum(sub_total) as jumlah')
            ->whereMonth('tanggal', $bulan)
            ->whereYear('tanggal','=',$year)->first();
            $chartmaterialkeluar[] = $chart->jumlah;
            }
        $q = array_map('intval',$chartmaterialkeluar);
        for($month=1;$month < 13;$month++){
            $chart     = Materialprpo::where('dept_id',$userid)
            ->
            selectRaw('sum(val_po) as jumlah')
            ->whereMonth('created_at', $month)
            ->whereYear('created_at','=',$year)->first();
            $chartpo[] = $chart->jumlah;
            }
        $x = array_map('intval',$chartpo);
        $budget = Budget::where('dept_id',$userid)->selectRaw('sum(budget) as sum')->pluck('sum')->first();
        $year = Carbon::now();
        $spendmaterial = Materialkeluar::where('dept_id',$userid)->selectRaw('sum(sub_total) as sum')->
        whereYear('created_at', '=', $year)->pluck('sum')->first();
        $spendpo = Materialprpo::where('dept_id',$userid)
        ->selectRaw('sum(val_po) as sum')->
        whereYear('created_at', '=', $year)->pluck('sum')->first();
        return view('index.dashboard',compact(['jmlminstok','q','x','year','spendmaterial','spendpo','pendingpr','budget']));
    }
    public function indexadmin()
    {
        $year = Carbon::now();
        $material = Material::count();
        $value = Material::selectRaw('sum(harga) as sum')->pluck('sum')->first();
        $spendpo = Materialprpo::selectRaw('sum(val_po) as sum')->
        whereYear('created_at', '=', $year)->pluck('sum')->first();
        // $val = Material::all();
        $val = Material::select('harga','stok_main',
        DB::raw('harga AS harga'),
        DB::raw('stok_main AS stok_main'))
        ->selectRaw('sum(harga * stok_main) as sum')
               ->pluck('sum')->first();
        $dept = Dept::count();
         return  view('index.dashboardadmin',compact(['material','year','spendpo','val','dept']));
        # code...
    }
    public function indexmain()
    {
        $year = Carbon::now();
        $material = Material::count();
        $value = Material::selectRaw('sum(harga) as sum')->pluck('sum')->first();
        $spendpo = Materialprpo::selectRaw('sum(val_po) as sum')->
        whereYear('created_at', '=', $year)->pluck('sum')->first();
        // $val = Material::all();
        $val = Material::select('harga','stok_main',
        DB::raw('harga AS harga'),
        DB::raw('stok_main AS stok_main'))
        ->selectRaw('sum(harga * stok_main) as sum')
               ->pluck('sum')->first();
        $dept = Dept::count();
         return  view('index.dashboardmain',compact(['material','year','spendpo','val','dept']));
        # code...
    }
}
