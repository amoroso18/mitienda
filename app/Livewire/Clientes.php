<?php

namespace App\Livewire;

use Livewire\Component;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\Cliente;
use App\Models\TipoCliente;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Clientes extends Component
{
    use LivewireAlert;


    public $tipo_documento_id = 1;
    public $documento_identidad;
    public $codigo_documento;
    public $denominacion;
    public $direccion;
    public $telefono;
    public $email;

    public $idSelect;
    public $editarShow = false;


    public function guardarCliente(Request $request){
   
        $rules = [
            'tipo_documento_id' => 'required',
            'documento_identidad' => 'required',
            'codigo_documento' => 'required',
            'denominacion' => 'required',
            'direccion' => 'required',
            'telefono' => 'required',
            'email' => 'required|email',
        ];

        // Validación
        $validator = Validator::make($request->all(), $rules);
        if($validator){
            Cliente::create([
                'tipo_documento_id' => $this->tipo_documento_id,
                'documento_identidad' => $this->documento_identidad,
                'codigo_documento' => $this->codigo_documento,
                'denominacion' => $this->denominacion,
                'direccion' => $this->direccion,
                'telefono' => $this->telefono,
                'email' => $this->email,
            ]);
        }
       
    }
    public function BorrarCliente(){
        $student = Cliente::find($this->idSelect);
       try {
        if ($student) {
            $student->delete();
            session()->flash('success', 'El cliente ha sido eliminado correctamente.');
        } else {
            session()->flash('error', 'No se pudo eliminar al cliente.');
        }
       } catch (\Throwable $th) {
        session()->flash('error', 'No se pudo eliminar al cliente.');
       }
    }
    public function EditarCliente(){
         // Actualizar el cliente específico basado en el ID seleccionado
         Cliente::where('id', $this->idSelect)->update([
            'tipo_documento_id' => $this->tipo_documento_id,
            'documento_identidad' => $this->documento_identidad,
            'codigo_documento' => $this->codigo_documento,
            'denominacion' => $this->denominacion,
            'direccion' => $this->direccion,
            'telefono' => $this->telefono,
            'email' => $this->email,
        ]);
        session()->flash('success', 'El cliente ha sido editado correctamente.');
        $this->CancelarEdicion();
    }
    public function render()
    {
        $tiposCliente = TipoCliente::all();
        $data =  Cliente::with('getTipoCliente')->get();
        return view('livewire.clientes', compact('data','tiposCliente'));
    }

    public function EditarIdListener($id){
        $dacliente = Cliente::find($id);
        $this->tipo_documento_id = $dacliente->tipo_documento_id;
        $this->documento_identidad = $dacliente->documento_identidad;
        $this->codigo_documento = $dacliente->codigo_documento;
        $this->denominacion = $dacliente->denominacion;
        $this->direccion = $dacliente->direccion;
        $this->telefono = $dacliente->telefono;
        $this->email = $dacliente->email;
        $this->idSelect = $id;
        $this->editarShow = true;
    }
    public function CancelarEdicion(){
        $this->editarShow = false;
    }
    public function AsignarIdListener($id){
        $this->idSelect = $id;
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