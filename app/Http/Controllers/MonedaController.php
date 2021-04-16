<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Moneda;


use App\EmpresaMoneda;
use DB;
use Carbon\Carbon;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class MonedaController extends Controller
{
    public function MonedaView($idempresa=0){
        $empresa = Empresa::find($idempresa);
      //  $EmpresaSigla = $empresa->sigla;
      //  $EmpresaNombre = $empresa->nombre;
        return view('Monedas.moneda',compact('idempresa'));
    }

   public function listarmonedas(Request $request){
		try{
			$activo 	= 1;
			$idMP 		= 0;
			$MonedaP    = 0;
			$trueque  =0;
			if($request->input('idem') <> null){
				$idMonedaP 	= DB::table('empresamoneda')
                             ->select('idMonedaPrincipal')
                             ->where('empresamoneda.idempresa',$request->input('idem'))
                             ->where('empresamoneda.activo', $activo)
                             ->first();
                $idMP = $idMonedaP->idMonedaPrincipal;

                $MonedaP 	= DB::table('moneda')
                             ->select('nombre')
                             ->where('moneda.id',$idMP)
							 ->first();

				$Trueque    = DB::table('empresamoneda')
							->select('Cambio')
							->where('empresamoneda.idempresa',$request->input('idem'))
							->where('empresamoneda.activo', $activo)
							->first();
				$trueque = $Trueque ->Cambio;
			}

			$monedas 	= DB::table('moneda')
                      		 ->get();
            
            
            //return $monedas;
            return response()->json([
					'mensaje'			=> "Listado de Empresas Exitoso",
					'titulo'			=> "Success",
					'tipoMensaje'		=> "success",
					'botonConfirmacion'	=> "ok",
					'Monedas'           => $monedas,
					'idMonedaP'			=> $idMP,
					'MonedaP'			=> $MonedaP,
					'Trueque'           =>$trueque

				]);
		}catch(Exception $e){
			return response()->json([
				'mensaje'			=> $e,
				'titulo'			=> "error",
				'tipoMensaje'		=> "error",
				'botonConfirmacion'	=> "ok"
			]);
		}
	}

	public function listarEM(Request $request){
		$idempresa = $request->input('IdEmpresa');
		$mon = DB::table('empresamoneda')
    					->where('empresamoneda.idEmpresa',$idempresa)
    					->orderby('empresamoneda.fechaRegistro','DESC')
    					->get();
		$idusuario = \Auth::user()->id;
        
		$monedas=array();
		foreach ($mon as &$m) {
			$monedaprincipal=Moneda::find($m->idMonedaPrincipal);
			$monedasecundaria="";
			if($m->idMonedaAlternativa!=null){
				$monedasecundaria=Moneda::find($m->idMonedaAlternativa)->nombre;
			}
			
			$mo = [
				"id"               => $m->id,
			    "NombrePrincipal"  => $monedaprincipal->nombre,
			    "NombreSecundario" => $monedasecundaria,
			    "Cambio" 		   => $m->cambio,
			    "FechaRegistro"	   => $m->fechaRegistro,
			    "Activo"           => $m->activo,
			    "monedapri"        => $m->idMonedaPrincipal,
			    "monedasec"        => $m->idMonedaAlternativa
			];
			$monedas[]=$mo;
		}
		$empresa = Empresa::find($idempresa);
       // $EmpresaSigla = $empresa->sigla;
     //   $EmpresaNombre = $empresa->nombre;
        return response()->json([
					'mensaje'			=> "Listado de Empresas Exitoso",
					'titulo'			=> "Success",
					'tipoMensaje'		=> "success",
					'botonConfirmacion'	=> "ok",
					'Monedas'           => $monedas
				]);
	}

	
}
