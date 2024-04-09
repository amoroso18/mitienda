<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\VentaController;

Route::get('/', function () {  return view('welcome');})->name('/');

// Rutas para el inicio de sesión
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);

// Rutas para el registro
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);

// Rutas para la recuperación de contraseña
Route::get('password/reset', [AuthController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [AuthController::class, 'reset'])->name('password.update');

Route::get('logout', [AuthController::class, 'logout'])->name('logout');


Route::get('usuarios', [UsuarioController::class, 'index'])->name('usuarios');
Route::get('clientes', [ClienteController::class, 'index'])->name('clientes');
Route::get('almacen', [ProductoController::class, 'index'])->name('almacen');
Route::get('compras', [VentaController::class, 'index'])->name('compras');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

