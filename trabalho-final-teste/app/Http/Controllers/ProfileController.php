<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;
use Carbon\Carbon;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

     public function show($id)
    {
        $dev = User::findOrFail($id);

        // calcula idade (se tiver dataNascimento)
        $idade = $dev->dataNascimento
            ? Carbon::parse($dev->dataNascimento)->age
            : null;

        return view('profile.show', compact('dev', 'idade'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        // Campos comuns
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->telefone = $request->input('telefone');
        $user->endereco = $request->input('endereco');
        $user->cpfOuCep = $request->input('cpfOuCep');

        // Campos específicos por tipo
        if ($user->type_id == 1) { // Desenvolvedor
            $user->dataNascimento = $request->input('dataNascimento');
            $user->descricao = $request->input('descricao');
        } elseif ($user->type_id == 2) { // Cliente
            $user->empresa = $request->input('empresa');
        }

        // Caso o email tenha sido alterado, zera verificação
        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'Perfil atualizado com sucesso!');
    }


    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
