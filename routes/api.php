<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/',function (){
    return ['api' => 'version 1.0.0'];
});
Route::get('invoices', 'DocumentsElectronics\Invoice\InvoiceController@processData');
Route::get('notes', 'DocumentsElectronics\Note\NoteController@processData');
Route::get('/invoice/{operacion}', 'DocumentsElectronics\Invoice\InvoiceController@examplegenerador');
Route::get('/notes/{operacion}', 'DocumentsElectronics\Note\NoteController@examplegenerador');
Route::get('/documento/{operacion}/{id}', 'DocumentsElectronics\Invoice\InvoiceController@generador');
Route::middleware('jwt.auth')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', 'JWT\ApiController@login');
Route::post('register', 'JWT\ApiController@register');
Route::middleware('jwt.auth')->get('logout','JWT\ApiController@logout');
Route::middleware(['jwt.auth'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
    Route::get('logout','JWT\ApiController@logout');
    /*Route::get('/documentosElectronicos', 'DocumentsElectronics\Invoice\InvoiceController@index');
    Route::get('/documentosElectronicos/{tipo}', 'DocumentsElectronics\Invoice\InvoiceController@show');*/
    Route::resource('series','Serie\SerieController',['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('tipoigv','TipoIGV\TipoigvController',['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('tipoidentificacion','Identificacion\TipoidentificacionController',['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('empresa','Enterprise\EnterpriseController',['only' => ['index', 'store', 'show', 'edit', 'update', 'destroy']]);
    Route::resource('office','Enterprise\Office\OfficeController',['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('account','Account\AccountController',['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::resource('documentosElectronicos','DocumentsElectronics\Invoice\InvoiceController',['only' => ['index', 'store', 'show', 'update', 'destroy']]);
    Route::get('combo/{tabla}', 'SelectCombo\SelectController@obtenerCombo');
    Route::get('buscarempresa/{id}', 'BusquedaPersonalidas\BuscarEmpresaController@buscarPorRuc');
    Route::post('obtenerSeries','BusquedaPersonalidas\BuscarEmpresaController@obtenerSerie');
});
Route::get('/generar', 'IniciarSistema\GeneradorDatosBasicos@generar');