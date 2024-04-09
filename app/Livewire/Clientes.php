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

    public $tiposCliente;
    public $data;
    // Otros campos y métodos

    public $tipo_documento_id = 1;
    public $documento_identidad;
    public $codigo_documento;
    public $denominacion;
    public $direccion;
    public $telefono;
    public $email;

    public function mount()
    {
        $this->tiposCliente = TipoCliente::all();
        $this->data =  Cliente::with('getTipoCliente')->get();
    }

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
            $this->reset(); // Limpiar los campos después de guardar
            $this->emit('clienteAgregado'); // Emitir un evento para cerrar el modal
        }
       
    }

    public function render()
    {
        return view('livewire.clientes');
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
