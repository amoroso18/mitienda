<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\TipoProducto;

class Categorias extends Component
{

    use LivewireAlert;

    public $descripcion;
    public $idSelect;
    public $editarShow = 4;

    public function render()
    {
        $TipoProducto = TipoProducto::get();
        return view('livewire.categorias',compact('TipoProducto'));
    }
    public function NuevoListener(){
        $this->editarShow = 1;
    }

    public function guardarProducto()
    {
        // Validación de los campos (puedes agregar más validaciones según tus necesidades)
        $this->validate([
            'descripcion' => 'required|string',
        ], [
            'descripcion.required' => 'El nombre de categoria es obligatorio.',
        ]);

        // Crear un nuevo producto
        TipoProducto::create([
            'descripcion' => $this->descripcion
        ]);

        session()->flash('success', 'Creado correctamente.');
        self::Cancelar();
    }

    public function EditarIdListener($id){

        $producto = TipoProducto::findOrFail($id);
        $this->descripcion = $producto->descripcion;

        $this->idSelect  = $id;
        $this->editarShow = 2;
    }

    
    public function actualizarProducto()
    {
        $this->validate([
            'descripcion' => 'required|string',
        ], [
            'descripcion.required' => 'El nombre de categoria es obligatorio.',
        ]);

        $producto = TipoProducto::findOrFail($this->idSelect);
        $producto->update([
            'descripcion' => $this->descripcion,
        ]);
        session()->flash('success', 'Actualizado correctamente.');
        self::Cancelar();
    }
    public function Cancelar(){
        $this->editarShow = 4;
    }
}