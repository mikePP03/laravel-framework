<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\EmpresaMoneda;
use DB;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EmpresaMonedaController extends Controller
{
     public function GuardarEmpresaMoneda(Request $request){
		try{

			$idusuario = \Auth::user()->id;
			$now= date("y/m/d");

			$moneda = new EmpresaMoneda;
			$moneda->cambio					= null;
			$moneda->activo		  			= 1;
			$moneda->fechaRegistro			= $now;
			$moneda->idEmpresa	    		= $request->input('idEmpresa');
			$moneda->idMonedaPrincipal		= $request->input('idMoneda');
			$moneda->idMonedaAlternativa	= null;
			$moneda->idUsuario	    		= $idusuario;

			$guardado = $moneda->save();


			if($guardado){
				return response()->json([
					'mensaje'			=> "Empresa Guardada Exitosamente",
					'titulo'			=> "Success",
					'tipoMensaje'		=> "success",
					'botonConfirmacion'	=> "ok",
					'moneda'            => $moneda
				]);
			}

		}
		catch(Exception $e){
			//dd($e);
			return response()->json([
				'mensaje'			=> $e,
				'titulo'			=> "error",
				'tipoMensaje'		=> "error",
				'botonConfirmacion'	=> "ok"
			]);
		}
	}
}
