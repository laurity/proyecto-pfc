<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Registrarse')]

class RegisterPage extends Component
{
    public $name;
    public $email;
    public $password;
    
    public function save()
    {
        $this->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users|max:255',
            'password' => ['required', 'min:6', 'max:255', 'regex:/[A-Z]/', 'regex:/[^a-zA-Z0-9]/'],
        ]);

        //Guardamos el usuario en la base de datos
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        //Iniciamos sesión
        auth()->login($user);

        //Redirigimos a la página de inicio
        return redirect()->intended(); //Redirigimos a la página a la que el usuario intentaba acceder antes de ser redirigido a la página de inicio
    }

    public function render()
    {
        return view('livewire.auth.register-page');
    }
}
