<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function __construct()
     {
         // Aplica el middleware 'auth' a todos los métodos del controlador
         $this->middleware('auth');
     }

    public function index()
    {
        return view('pages.categoria');
        // return Livewire::mount('clientes');
    }
}
