<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Models\User;
use App\Models\TipoEstadoUsuario;
use App\Models\TipoUsuario;

class Usuarios extends Component
{
    use LivewireAlert;

    public $usuarios;
    public $tipo_usuarios_id =1;
    public $tipo_estado_usuarios_id =1;
    public $email;
    public $name;
    public $password;

    public $idSelect;
    public $editarShow = false;


    public function render()
    {
        $data = User::with('getEstado','getPerfil')->get();
        $TipoEstadoUsuario = TipoEstadoUsuario::get();
        $TipoUsuario = TipoUsuario::get();
        return view('livewire.usuarios',compact('data','TipoEstadoUsuario','TipoUsuario'));
    }
    public function BorrarCliente(){
        $student = User::find($this->idSelect);
        try {
            if ($student) {
                $student->delete();
                session()->flash('success', 'El usuario ha sido eliminado correctamente.');
            } else {
                session()->flash('error', 'No se pudo eliminar al usuario.');
            }
        } catch (\Throwable $th) {
            session()->flash('error', 'No se pudo eliminar al usuario.');
        }
    }
    public function EditarIdListener($id){
        $usuario = User::find($id);
        $this->tipo_usuarios_id = $usuario->tipo_usuarios_id;
        $this->tipo_estado_usuarios_id = $usuario->tipo_estado_usuarios_id;
        $this->email = $usuario->email;
        $this->name = $usuario->name;
        $this->idSelect = $id;
        $this->editarShow = true;
    }

    public function EditarCliente(){
        // Actualizar el cliente específico basado en el ID seleccionado
        User::where('id', $this->idSelect)->update([
            'tipo_usuarios_id' => $this->tipo_usuarios_id,
            'tipo_estado_usuarios_id' => $this->tipo_estado_usuarios_id,
            'name' => $this->name,
            // 'password' => bcrypt($this->password),
       ]);
       session()->flash('success', 'El usuario ha sido editado correctamente.');
       $this->CancelarEdicion();
   }

    public function CancelarEdicion(){
        $this->editarShow = false;
    }
    public function AsignarIdListener($id){
        $this->idSelect = $id;
    }
}
