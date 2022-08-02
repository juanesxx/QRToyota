<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\CuponRequest;
use Illuminate\Session\SessionManager;
use App\Models\Cupon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    protected function store(Request $request, SessionManager $sessionManager){
        
        $user = DB::table('cupons')->where('placa', $request->placa)->first();
        $who = Auth::user();
        if($user == null){
            $sessionManager->flash('errorOne', 'Este cupón no está registrado');
            return redirect()->route('home');
        }
        if($user->enabled == 1){
            DB::table('cupons')
            ->where('placa', $request->placa)
            ->update(['enabled' => false, 'city' => $who->city, 'updated_at' => now(), 'who' => $who->name]);
            $sessionManager->flash('success', 'Cupón redimido');
            return redirect()->route('home');
        }
        $sessionManager->flash('errorTwo', "Este cupón ya fue redimido en $user->city");
        $sessionManager->flash('who',"Por: $user->who");
        $sessionManager->flash('updated',"El día y la hora: $user->updated_at");
        return redirect()->route('home');
    }
}
