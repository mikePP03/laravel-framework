<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;


use App\EmpresaMoneda;
use DB;
use Carbon\Carbon;
use \Milon\Barcode\DNS2D;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EmpresaController extends Controller
{
	public function listarempresas(Request $request){
		try{
			$empresas = DB::table('empresa')
                      ->where('empresa.estado','0')
                      ->get();
            //return $empresas;
            return response()->json([
					'mensaje'			=> "Listado de Empresas Exitoso",
					'titulo'			=> "Success",
					'tipoMensaje'		=> "success",
					'botonConfirmacion'	=> "ok",
					'Empresas'          => $empresas

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

	public function TraerEmpresa(Request $request){
		try{
            $empresa=DB::table('empresa')
                        ->where('empresa.id',$request->input('IdEmpresa'))
						->first();
		
						$empresamoneda=DB::table('empresamoneda')
                        ->select('idMonedaPrincipal')
                        ->where('empresamoneda.idEmpresa',$request->input('IdEmpresa'))
                        ->first();

			return response()->json([
				'mensaje'			=> "Empresa Actualizada Exitosamente",
				'titulo'			=> "Success",
				'tipoMensaje'		=> "success",
				'botonConfirmacion'	=> "ok",
				'Empresa'           => $empresa,
				'EmpresaMoneda'		=> $empresamoneda
			]);

		}
		catch(Exception $e){
			return response()->json([
				'mensaje'			=> $e,
				'titulo'			=> "error",
				'tipoMensaje'		=> "error",
				'botonConfirmacion'	=> "ok"
			]);
		}
	}

    public function GuardarEmpresa(Request $request){
		try{
			$idusuario = \Auth::user()->id;
			$nombre = DB::table('empresa')
                            ->where(strtolower('empresa.Nombre'),strtolower($request->input('NombreEmpresa')))
                            ->first();
            $nit = DB::table('empresa')
                            ->where(strtolower('empresa.Nit'),strtolower($request->input('NitEmpresa')))
                            ->first();
            $sigla = DB::table('empresa')
                            ->where(strtolower('empresa.Sigla'),strtolower($request->input('SiglaEmpresa')))
                            ->first();
            if($nombre!=null){
            	return response()->json([
					'mensaje'			=> "Ya existe una empresa con este nombre",
					'titulo'			=> "Error",
					'tipoMensaje'		=> "error",
					'botonConfirmacion'	=> "ok"
				]);
            }
            if($nit!=null){
            	return response()->json([
					'mensaje'			=> "Ya existe una empresa con este nit",
					'titulo'			=> "Error",
					'tipoMensaje'		=> "error",
					'botonConfirmacion'	=> "ok"
				]);
            }
            if($sigla!=null){
            	return response()->json([
					'mensaje'			=> "Ya existe una empresa con esta sigla",
					'titulo'			=> "Error",
					'tipoMensaje'		=> "error",
					'botonConfirmacion'	=> "ok"
				]);
            }

			$empresa = new Empresa;
			$empresa->nombre		= $request->input('NombreEmpresa');
			$empresa->nit		    = $request->input('NitEmpresa');
			$empresa->sigla		    = $request->input('SiglaEmpresa');
			$empresa->telefono	    = $request->input('TelefonoEmpresa') . " ";
			$empresa->correo	    = $request->input('CorreoEmpresa'). " ";
			$empresa->direccion		= $request->input('DireccionEmpresa'). " ";
			$empresa->niveles	    = $request->input('NivelesEmpresa');
			$empresa->estado	    = 0;
			$empresa->idusuario	    = $idusuario;

			$guardado = $empresa->save();


		
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

	public function EditarEmpresa(Request $request){
		try{
            $empresa=DB::table('empresa')
                        ->where('empresa.id',$request->input('IdEmpresa'))
                        ->first();
            if(strtolower($empresa->nombre)==strtolower($request->input('NombreEmpresa'))){
            }else{
            	$nombre = DB::table('empresa')
                            ->where(strtolower('empresa.Nombre'),strtolower($request->input('NombreEmpresa')))
                            ->first();
                if($nombre!=null){
            	return response()->json([
					'mensaje'			=> "Ya existe una empresa con este nombre",
					'titulo'			=> "Error",
					'tipoMensaje'		=> "error",
					'botonConfirmacion'	=> "ok"
				]);
            }
            }
            if(strtolower($empresa->nit)==strtolower($request->input('NitEmpresa'))){	
        	}
            else{
            	$nit = DB::table('empresa')
                            ->where(strtolower('empresa.Nit'),strtolower($request->input('NitEmpresa')))
                            ->first();
                if($nit!=null){
            	return response()->json([
					'mensaje'			=> "Ya existe una empresa con este nit",
					'titulo'			=> "Error",
					'tipoMensaje'		=> "error",
					'botonConfirmacion'	=> "ok"
				]);
            }
            }
            if(strtolower($empresa->sigla)==strtolower($request->input('SiglaEmpresa'))){
    	    }
    	    else{
    	    	$sigla = DB::table('empresa')
                            ->where(strtolower('empresa.Sigla'),strtolower($request->input('SiglaEmpresa')))
                            ->first();         
				if($sigla!=null){
					return response()->json([
						'mensaje'			=> "Ya existe una empresa con esta sigla",
						'titulo'			=> "Error",
						'tipoMensaje'		=> "error",
						'botonConfirmacion'	=> "ok"
					]);
				}
    	    }
    	    $empresaac=Empresa::where('empresa.id', $request->input('IdEmpresa'))
							->first();

			$empresaac->nombre		= $request->input('NombreEmpresa');
			$empresaac->nit		    = $request->input('NitEmpresa');
			$empresaac->sigla		    = $request->input('SiglaEmpresa');
			$empresaac->telefono	    = $request->input('TelefonoEmpresa'). " ";
			$empresaac->correo	    = $request->input('CorreoEmpresa'). " ";
			$empresaac->direccion		= $request->input('DireccionEmpresa'). " ";
			$empresaac->niveles	    = $request->input('NivelesEmpresa');

			$guardado = $empresaac->save();

			if($guardado){
				return response()->json([
					'mensaje'			=> "Empresa Actualizada Exitosamente",
					'titulo'			=> "Success",
					'tipoMensaje'		=> "success",
					'botonConfirmacion'	=> "ok",
					'Empresa'           => $empresaac
				]);
			}

		}
		catch(Exception $e){
			return response()->json([
				'mensaje'			=> $e,
				'titulo'			=> "error",
				'tipoMensaje'		=> "error",
				'botonConfirmacion'	=> "ok"
			]);
		}
	}

	
	public function EliminarEmpresa(Request $request){
		try{

  
			$empresa=Empresa::find($request->input('IdEmpresa'));
            $eliminado=false;                
        	$empresa->estado=1;
        	$empresa->save();
        	$eliminado=true;
			if($eliminado==true){
				return response()->json([
					'mensaje'			=> "Empresa eliminada Exitosamente",
					'titulo'			=> "Success",
					'tipoMensaje'		=> "success",
					'botonConfirmacion'	=> "ok",
					'IdEmpresa'         => $empresa->id
				]);
			}    

		}
		catch(Exception $e){
			//dd($e);
			return response()->json([
				'mensaje'			=> "Error a intentar eliminar la Empresa",
				'titulo'			=> "error",
				'tipoMensaje'		=> "error",
				'botonConfirmacion'	=> "ok"
			]);
		}
	}

	// public function EliminarEmpresa(Request $request){
	// 	try{
	// 		$empresa=Empresa::find($request->input('IdEmpresa'));
    //         $eliminado=false;                
    //     	$empresa->estado=1;
    //     	$empresa->save();
    //     	$eliminado=true;
	// 		if($eliminado==true){
	// 			return response()->json([
	// 				'mensaje'			=> "Empresa eliminada Exitosamente",
	// 				'titulo'			=> "Success",
	// 				'tipoMensaje'		=> "success",
	// 				'botonConfirmacion'	=> "ok",
	// 				'IdEmpresa'         => $empresa->id
	// 			]);
	// 		}     

	// 	}
	// 	catch(Exception $e){
	// 		//dd($e);
	// 		return response()->json([
	// 			'mensaje'			=> "Error a intentar eliminar la Empresa",
	// 			'titulo'			=> "error",
	// 			'tipoMensaje'		=> "error",
	// 			'botonConfirmacion'	=> "ok"
	// 		]);
	// 	}
	// }



}
