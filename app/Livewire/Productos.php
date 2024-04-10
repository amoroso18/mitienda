<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Producto;
use App\Models\TipoProducto;

class Productos extends Component
{
    use LivewireAlert;

    public $nombre;
    public $descripcion;
    public $precio;
    public $stock;
    public $tipo_estado_tipos_id = 1;

    public $idSelect;
    public $editarShow = 4;

    public function render()
    {
        $data = Producto::with('getTipoProducto')->get();
        $TipoProducto = TipoProducto::get();
        
        return view('livewire.productos',compact('data','TipoProducto'));
    }

    public function NuevoListener(){
        $this->editarShow = 1;
    }
    public function guardarProducto()
    {
        // Validación de los campos (puedes agregar más validaciones según tus necesidades)
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'tipo_estado_tipos_id' => 'required|exists:tipo_productos,id',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre del producto no debe exceder los 255 caracteres.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser menor que cero.',
            'stock.required' => 'El stock del producto es obligatorio.',
            'stock.integer' => 'El stock debe ser un valor entero.',
            'stock.min' => 'El stock no puede ser menor que cero.',
            'tipo_estado_tipos_id.required' => 'Seleccione un tipo de estado válido para el producto.',
            'tipo_estado_tipos_id.exists' => 'El tipo de estado seleccionado no es válido.',
        ]);

        // Crear un nuevo producto
        Producto::create([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'tipo_estado_tipos_id' => $this->tipo_estado_tipos_id,
        ]);

        session()->flash('success', 'Producto creado correctamente.');
        self::Cancelar();
        }

    public function EditarIdListener($id){

        $producto = Producto::findOrFail($id);
        $this->nombre = $producto->nombre;
        $this->descripcion = $producto->descripcion;
        $this->precio = $producto->precio;
        $this->stock = $producto->stock;
        $this->tipo_estado_tipos_id = $producto->tipo_estado_tipos_id;

        $this->idSelect  = $id;
        $this->editarShow = 2;
    }

    
    public function actualizarProducto()
    {
        $this->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'tipo_estado_tipos_id' => 'required|exists:tipo_productos,id',
        ], [
            'nombre.required' => 'El nombre del producto es obligatorio.',
            'nombre.max' => 'El nombre del producto no debe exceder los 255 caracteres.',
            'precio.required' => 'El precio del producto es obligatorio.',
            'precio.numeric' => 'El precio debe ser un valor numérico.',
            'precio.min' => 'El precio no puede ser menor que cero.',
            'stock.required' => 'El stock del producto es obligatorio.',
            'stock.integer' => 'El stock debe ser un valor entero.',
            'stock.min' => 'El stock no puede ser menor que cero.',
            'tipo_estado_tipos_id.required' => 'Seleccione un tipo de estado válido para el producto.',
            'tipo_estado_tipos_id.exists' => 'El tipo de estado seleccionado no es válido.',
        ]);

        $producto = Producto::findOrFail($this->idSelect);
        $producto->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
            'precio' => $this->precio,
            'stock' => $this->stock,
            'tipo_estado_tipos_id' => $this->tipo_estado_tipos_id,
        ]);

        session()->flash('success', 'Producto actualizado correctamente.');
        self::Cancelar();
    }

    public function EliminarIdListener($id){
        $this->idSelect  = $id;
        $this->editarShow = 3;
    }
    public function BorrarCliente(){
        $student = Producto::find($this->idSelect);
       try {
        if ($student) {
            $student->delete();
            session()->flash('success', 'El Producto ha sido eliminado correctamente.');
        } else {
            session()->flash('error', 'No se pudo eliminar al Producto.');
        }
       } catch (\Throwable $th) {
        session()->flash('error', 'No se pudo eliminar al Producto.');
       }
       $this->editarShow = 4;
    }
    public function Cancelar(){
        $this->editarShow = 4;
    }
}