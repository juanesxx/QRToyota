<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Exports\CuponsExport;
use Maatwebsite\Excel\Facades\Excel;

class ReportesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $cuponsRedimidos = DB::table('cupons')->where('enabled', 0)->get();
        $cuponsRedimibles = DB::table('cupons')->where('enabled', 1)->get();
        if(Auth::user()->hasRole('admin')){
            return view('reportes-admin', compact(['cuponsRedimidos', 'cuponsRedimibles']));
        }else if(Auth::user()->hasRole('rol2')){
            return view('reportes-aux', compact(['cuponsRedimidos']));
        }
    }

    public function exportar(){
        return Excel::download(new CuponsExport, 'cupones.xlsx');
    }

}
