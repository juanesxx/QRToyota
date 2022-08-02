<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Session\SessionManager;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\RegistroRequest;
use App\Imports\UsersImports;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\CuponsExport;
use App\Imports\UsersImport;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('register-admin');
    }

    public function create(RegistroRequest $request, SessionManager $sessionManager)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'city' => $request->city,
        ])->assignRole($request->rol);
        $sessionManager->flash('registed',"El usuario fue registrado exitosamente");
          
        return redirect()->route('index.admin');
    }

    public function import(Request $request){
        Excel::import(new UsersImport, $request->file('users'));
        
        return redirect()->back();
    }

}
