<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TipoUsuario;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create($type): View
    {
    
        return view('auth.register',compact(['type']));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
        'name'  => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:usuario,email'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'type'  => ['required', 'exists:tipos_usuarios,id']
    ]);

    $user = new User();
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->tipo_usuario = $request->input('type');
    $user->dataCriacao = now();
    $user->ativo = true;
    $user->avaliacao = 0;

$user->save();

    // Evento padrão de registro
    event(new Registered($user));

    // Login automático
    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}

}
