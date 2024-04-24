<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\TipoProducto;
use App\Models\TipoCantidad;

use App\Models\Producto;
use App\Models\Cliente;
use App\Models\Venta;
use App\Models\VentaProducto;
use App\Models\TipoEstadoVenta;

class Ventas extends Component
{
    use LivewireAlert;
       
    public $cliente_id = 1;
    public $usuario_id = 1;
    public $tipo_estado_venta_id = 1;
    public $total = 0;
       
    public $idcantidades = 1;
    public $idCategoria;
    public $idSelect;
    public $cantidad = 0;
    public $editarShow = 4;
    public $carrito = [];
    public $categorias = [];
    public $cantidades = [];
    public $sumasubtotal = 0;
    public $sumatotal = 0;
    public $igv = 0;


    public $factura = null;

    public function mount()
    {
        $this->categorias = TipoProducto::get();
        $this->cantidades = TipoCantidad::get();
    }

    public function render()
    {
        $Venta = Venta::with('cliente','usuario','tipoEstadoVenta')->get();
        $Cliente = Cliente::get();
        $TipoEstadoVenta = TipoEstadoVenta::where('id','!=',3)->get();
        // $Producto = Producto::with('getTipoProducto')->get();
        $carrito = $this->carrito;

        $Producto = [];
        if ($this->idCategoria) {
            // $this->idSelect = null;
            $Producto = Producto::with('getTipoProducto')->where('tipo_estado_tipos_id', $this->idCategoria)->get();
        }

        return view('livewire.ventas',compact('Producto','Venta','Cliente','TipoEstadoVenta','carrito'));
    }
    public function NuevoListener(){
        $this->editarShow = 1;
    }
    public function agregarCarrito(){
        $producto = Producto::find($this->idSelect);
        $tipoCantidad = TipoCantidad::find($this->idcantidades);
        $subtotal = $producto->precio * $this->cantidad;

        // Verificar si el producto ya existe en el carrito
        $index = null;
        foreach ($this->carrito as $key => $item) {
            if ($item['id'] == $producto->id) {
                if ($item['tipo'] == $tipoCantidad->descripcion) {
                    // Si el producto ya está en el carrito con el mismo tipo de cantidad, aumentar la cantidad y subtotal
                    $this->carrito[$key]['cantidad'] += $this->cantidad;
                    $this->carrito[$key]['subtotal'] += $subtotal;
                    $index = $key;
                    break;
                } else {
                    // Si el producto ya está en el carrito pero con un tipo de cantidad diferente, crear una nueva entrada
                    continue;
                }
            }
        }

        // Si no se encontró una coincidencia con el mismo tipo de cantidad, agregar un nuevo producto al carrito
        if ($index === null) {
            $this->carrito[] = [
                "id" => $producto->id,
                "descripcion" => $producto->descripcion,
                "precio" => $producto->precio,
                "cantidad" => $this->cantidad,
                "tipo" => $tipoCantidad->descripcion,
                "subtotal" => $subtotal
            ];
        }

        // Llamar a una función para evaluar los datos (si existe)
        self::evaluardata();

        // Reiniciar el valor de idSelect después de agregar el producto al carrito
        $this->idSelect = null;
    }
    public function BorrarCarrito($indice){
        if (isset($this->carrito[$indice])) {
            // Elimina el elemento del arreglo utilizando unset()
            unset($this->carrito[$indice]);
            // Llama a la función para reevaluar los datos del carrito
            $this->evaluardata();
        }
    }
    public function evaluardata(){
        $sumasubtotal = 0;
        $sumatotal = 0;
        foreach ($this->carrito as $key => $value) {
            $sumasubtotal = $sumasubtotal + $value['subtotal'];
            $subtotal =  $value['precio'] *  $value['cantidad'];
            $sumatotal = $sumatotal + $subtotal;
        }

        $igvPercentage = 0.18; // Porcentaje del IGV (18%)
        $this->igv = number_format($sumatotal * $igvPercentage, 2);
        $total = $sumatotal + $this->igv;


        $this->sumatotal =  number_format($total, 2);
        $this->sumasubtotal =  number_format($sumatotal, 2);
    }
    public function guardarVenta()
    {
       try {
        $venta = Venta::create([
            'cliente_id' => $this->cliente_id,
            'usuario_id' => Auth::user()->id,
            'tipo_estado_venta_id' => $this->tipo_estado_venta_id,
            'subtotal' => $this->sumasubtotal,
            'igv' => $this->igv,
            'total' => $this->sumatotal,
            'descuento' => 0,
        ]);
        if( $venta){
            foreach ($this->carrito  as $key => $value) {
                $tg = new VentaProducto();
                $tg->venta_id =  $venta->id;
                $tg->cantidad =  $value['cantidad'];
                $tg->producto_id =  $value['id'];
                $tg->tipo =  $value['tipo'];
                $tg->precio_unitario = $value['precio'];
                $tg->save();
            }
        }
        $ventaId = $venta->id;
        session()->flash('success', 'Venta creada correctamente.');
        self::Cancelar();
       } catch (\Throwable $th) {
        session()->flash('error', 'No se pudo completar la venta');
       }
    }
    public function EditarIdListener($id){
        $this->editarShow = 2;
        $this->factura = Venta::with('cliente', 'usuario', 'tipoEstadoVenta', 'productos')
        ->where('id', $id)
        ->first();
        // dd($this->factura->productos);
     
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
    public function updatedIdCategoria($value)
    {
        if ($this->idCategoria) {
            $this->idSelect = null;
        }
    }
}