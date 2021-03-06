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
/*Route::get('/', function()
{

});*/


Route::get('/', function () {
    return view('webcajero.welcome');
});
//nos vamos a la vista del cajero
Route::get('/cajero', function(){
    return view('webcajero.cajero');
});


//get
Route::get('/mesaofactura', function(){
    return view('webcajero.mesaofactura');
});
Route::get('/buscarfactura', 'BuscarFacturaController@index');
Route::get('/buscarmesa', 'BuscarMesaController@index');
Route::get('/imprimir/{imprimir}', 'imprimirController@imprimir')->name('imprimirfactura');

///post
Route::post('/buscarfactura', 'BuscarFacturaController@find')->name('buscarfactura');
Route::post('/welcome', 'autController@ingresar');
Route::post('/buscarmesa', 'BuscarMesaController@find')->name('buscarmesa');
Route::post('/variablesimprimir', 'imprimirController@variables' )->name('variablesfactura');
Route::post('/buscarfacturacliente', 'BuscarFacturaController@verfacturas')->name('facturacliente');


//patch //
//Route::patch('/buscarmesa', 'BuscarMesaController@actualizarped' );
Route::get('/emailcontactar', 'EmailController@index');
Route::post('/contactar', 'EmailController@contact')->name('contact');

//Reportes
Route::post('tabla', 'ReporteController@crearReporte')->name('tablacrear');
Route::get('form', 'ReporteController@form');
Route::post('descargar-reporte', 'ReporteController@excel')->name('products.excel');
Auth::routes();

//Reporte Facturas por día
Route::post('facturasDia', 'ReporteFacsController@crearReporte')->name('facsDia');
Route::post('facturaSolicitada', 'ReporteFacsController@FacturaInd')->name('facturaindividual');

Route::get('/home', 'HomeController@index')->name('home');


//Administrador
Route::get('/Administrador', 'WebAdmin\PageController@admin')->name('admin');


Route::resource('platos', 'Admin\PlatoController');
Route::resource('empleados', 'Admin\EmpleadoController');

