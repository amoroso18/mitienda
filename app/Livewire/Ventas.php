<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\TipoProducto;

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
       
    public $idSelect = 1;
    public $cantidad = 0;
    public $editarShow = 4;
    public $carrito = [];
    public $sumasubtotal = 0;
    public $sumatotal = 0;
    public $igv = 0;


    public $factura = null;

    public function render()
    {

        $Venta = Venta::with('cliente','usuario','tipoEstadoVenta')->get();
        $Cliente = Cliente::get();
        $TipoEstadoVenta = TipoEstadoVenta::where('id','!=',3)->get();
        $Producto = Producto::with('getTipoProducto')->get();
        $carrito = $this->carrito;
        return view('livewire.ventas',compact('Producto','Venta','Cliente','TipoEstadoVenta','carrito'));
    }

    public function NuevoListener(){
        $this->editarShow = 1;
    }
    public function agregarCarrito(){
        $pro = Producto::find($this->idSelect);
        $subtotal = $pro->precio*$this->cantidad;
        $this->carrito[] = [
            "id" => $pro->id,
            "descripcion" => $pro->descripcion,
            "precio" => $pro->precio,
            "cantidad" => $this->cantidad,
            "subtotal" => $subtotal
        ];
        self::evaluardata();
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
                $tg->cantidad =  $value['id'];
                $tg->producto_id =  $value['cantidad'];
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