<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends Controller
{
   
    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email'
    ];

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        // Mensajes de error personalizados
        $messages = [
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'password.required' => 'El campo contraseña es obligatorio.',
        ];

        // Validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Verificar si el usuario existe
        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return redirect()->back()->withErrors(['email' => 'El usuario no existe.'])->withInput();
        }

        // Verificar si la contraseña es correcta
        if (!password_verify($request->password, $user->password)) {
            return redirect()->back()->withErrors(['password' => 'Contraseña incorrecta.'])->withInput();
        }

        // Verificar el estado del usuario
        if ($user->tipo_estado_usuarios_id != 1) { // Suponiendo que 1 es el ID de estado activo
            return redirect()->back()->withErrors(['email' => 'El usuario está suspendido.'])->withInput();
        }

        Auth::login($user);
        return redirect('/')->with('success', '¡Bienvenido(a)!');

    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }
    public function register(Request $request)
    {
        // Reglas de validación
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ];

        // Mensajes de error personalizados
        $messages = [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.max' => 'El campo nombre no debe tener más de 255 caracteres.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El email debe ser una dirección de correo electrónico válida.',
            'email.unique' => 'El email ya está en uso.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min' => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed' => 'La confirmación de la contraseña no coincide.',
        ];

        // Validación
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si la validación falla
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Crear el nuevo usuario
        $user = new User();
        $user->tipo_usuarios_id = 1;
        $user->tipo_estado_usuarios_id = 1;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->save();

        // Hacer lo que sea necesario después del registro (por ejemplo, iniciar sesión, redirigir, etc.)
        Auth::login($user);
        return redirect('/')->with('success', '¡Registro exitoso!');
    }
    public function showLinkRequestForm()
    {
        
    }
    public function sendResetLinkEmail()
    {

    }
    public function showResetForm()
    {
        
    }
    public function reset()
    {

    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}
