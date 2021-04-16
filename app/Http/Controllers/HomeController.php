<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\empresa;
use App\gestion;

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
        $empresas = DB::table('empresa')
                      ->where('empresa.estado','0')
                      ->get();
        $idusuario = \Auth::user()->id;
      
       
       return view('empresas.empresa',compact('empresas'));
    }
    public function menu($idempresa){
        try{
          $empresa = Empresa::find($idempresa);
          $EmpresaSigla = $empresa->sigla;
          $EmpresaNombre = $empresa->nombre;
          $idusuario = \Auth::user()->id;
         
          return view('dashboard',compact('idempresa','EmpresaSigla','EmpresaNombre'));
        }
        catch(Exception $e){
          dd($e);
        }
          
      }
}
