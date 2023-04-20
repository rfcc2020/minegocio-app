<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/reportes/resumen', [App\Http\Controllers\ReporteController::class, 'index'])->name('resumen');
Route::post('/reportes/resumen/', [App\Http\Controllers\ReporteController::class, 'actualiza'])->name('resumen');

//Route Hooks - Do not delete//
	Route::view('saldos', 'livewire.saldos.index')->middleware('auth');
	Route::view('detalleventaproductos', 'livewire.detalleventaproductos.index')->middleware('auth');
	Route::view('detalleventaservicios', 'livewire.detalleventaservicios.index')->middleware('auth');
	Route::view('ventas', 'livewire.ventas.index')->middleware('auth');
	Route::view('detallecompras', 'livewire.detallecompras.index')->middleware('auth');
	Route::view('compras', 'livewire.compras.index')->middleware('auth');
	Route::view('productos', 'livewire.productos.index')->middleware('auth');
	Route::view('proveedores', 'livewire.proveedores.index')->middleware('auth');
	Route::view('servicios', 'livewire.servicios.index')->middleware('auth');
	Route::view('clientes', 'livewire.clientes.index')->middleware('auth');