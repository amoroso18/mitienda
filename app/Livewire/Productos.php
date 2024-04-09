<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Producto;

class Productos extends Component
{
    use LivewireAlert;

    public function render()
    {
        $data = Producto::with('getTipoProducto')->get();
        return view('livewire.productos',compact('data'));
    }
    
    private function felicidades($mensaje){
        session()->flash('success', "Felicidades, tu acción fue procesada correctamente.");
        return  $this->alert('success', 'Felicidades',[
            'timer' => '25000',
            'toast' => false,
            'position' => 'center',
            'text' => $mensaje,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Cerrar',
        ]);
    }
    private function error(){
        session()->flash('error', "Error inesperado, al parecer estas intentado ingresar un valor no aceptado o algo esta fallando, vuelve a cargar el navegador.");
        return $this->alert('danger', 'Error',[
            'timer' => '25000',
            'toast' => false,
            'position' => 'center',
            'text' => $mensaje,
            'showConfirmButton' => true,
            'confirmButtonText' => 'Cerrar',
        ]);
    }
}
