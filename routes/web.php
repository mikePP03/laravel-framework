<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/************Dashboard */
    Route::get('/menu/{idempresa}',[
        'as'	=> 'gotomenu',
        'uses'	=> 'HomeController@menu'
    ])->middleware('auth');
/******Empresa*******/
    Route::post('empresas/listarempresas', [
        'as'	=> 'listar-empresas',
        'uses'	=> 'EmpresaController@listarempresas'
    ])->middleware('auth');
    Route::post('empresas/TraerEmpresa', [
        'as'	=> 'Traer-empresa',
        'uses'	=> 'EmpresaController@TraerEmpresa'
    ])->middleware('auth');
    Route::post('empresas/crear-empresa', [
        'as'	=> 'crear-empresa',
        'uses'	=> 'EmpresaController@GuardarEmpresa'
    ])->middleware('auth');
    Route::post('empresas/actualizar-empresa', [
        'as'	=> 'actualizar-empresa',
        'uses'	=> 'EmpresaController@EditarEmpresa'
    ])->middleware('auth');
    Route::post('empresas/eliminar-empresa', [
        'as'	=> 'eliminar-empresa',
        'uses'	=> 'EmpresaController@EliminarEmpresa'
    ])->middleware('auth');
    Route::get('empresas/repemp', [
        'as'	=> 'empresas-reporte',
        'uses'	=> 'EmpresaController@reporteEmpresa'
    ])->middleware('auth');

 
    /******Usuario*******/



Route::get('/menu/{idempresa}',[
    'as'	=> 'gotomenu',
    'uses'	=> 'HomeController@menu'
])->middleware('auth');

Route::get('/', [
'as'	=> 'root',
'uses'	=> 'HomeController@index'
])->middleware('auth');


Route::get('/', [
    'as'	=> 'root',
    'uses'	=> 'HomeController@index'
    ])->middleware('auth');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
/******Moneda******/

Route::get('Moneda/{idempresa}', [
    'as'	=> 'configuracion-moneda',
    'uses'	=> 'MonedaController@MonedaView'
])->middleware('auth');
Route::post('Moneda/listarmonedas', [
    'as'	=> 'listar-monedas',
    'uses'	=> 'MonedaController@listarmonedas'
])->middleware('auth');
Route::post('Moneda/listarEM', [
    'as'	=> 'listar-EmpresaMoneda',
    'uses'	=> 'MonedaController@listarEM'
])->middleware('auth');
Route::post('Moneda/AgregarMoneda', [
    'as'	=> 'agregar-MonedaAlternativa',
    'uses'	=> 'MonedaController@AgregarMoneda'
])->middleware('auth');


/******EmpresaMoneda******/
Route::post('empresamoneda/crear-empresamoneda', [
    'as'	=> 'crear-empresamoneda',
    'uses'	=> 'EmpresaMonedaController@GuardarEmpresaMoneda'
])->middleware('auth');

