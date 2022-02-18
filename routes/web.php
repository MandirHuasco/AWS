<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\InventarioController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/usuario-activar', [UserController::class, 'activar']);
Route::post('/usuario-desactivar', [UserController::class, 'desactivar']);

/*VISTAS*/

Route::view('/perfil', 'perfil');
Route::get('/perfil', [UserController::class, "mostrar"]);

/*PRODUCTO*/

Route::view('/producto', 'producto');
Route::get('/producto', [ProductoController::class, "Mostrar"])->name('productos');
Route::post('/producto', [ProductoController::class, 'CrearProducto']);
Route::post('/producto-activar', [ProductoController::class, 'activar']);
Route::post('/producto-desactivar', [ProductoController::class, 'desactivar']);

/*FACTURAS*/

Route::view('/facturas', 'factura');
Route::get('/facturas', [FacturaController::class, "Mostrar"])->name('facturas');
Route::post('/facturas', [FacturaController::class, 'CrearFactura']);
Route::post('/factura-activar', [FacturaController::class, 'activar']);
Route::post('/factura-desactivar', [FacturaController::class, 'desactivar']);
Route::post('/factura-update', [FacturaController::class,'editar'])->name('facturas.update');

/*ENTRADAS*/

Route::view('/entradas', 'entradas');
Route::get('/entradas', [EntradaController::class, "Mostrar"])->name('entradas');
Route::post('/entradas', [EntradaController::class, 'CrearEntrada']);
Route::post('/entrada-activar', [EntradaController::class, 'activar']);
Route::post('/entrada-desactivar', [EntradaController::class, 'desactivar']);

/*SALIDAS*/

Route::view('/salidas', 'salidas');
Route::get('/salidas', [SalidaController::class, "Mostrar"])->name('salidas');
Route::post('/salidas', [SalidaController::class, 'CrearSalida']);
Route::post('/salida-activar', [SalidaController::class, 'activar']);
Route::post('/salida-desactivar', [SalidaController::class, 'desactivar']);

/*INVENTARIO*/

Route::view('/inventario', 'inventario');
Route::get('/inventario', [InventarioController::class, "Mostrar"])->name('inventario');
Route::post('/inventario-activar', [InventarioController::class, 'activar']);
Route::post('/inventario-desactivar', [InventarioController::class, 'desactivar']);

/*PERFIL*/

Route::post('/actualizar', [UserController::class, "actualizar"]);
