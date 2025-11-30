<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserProfileController extends Controller
{
    /**
     * Exibe o formulário de edição do perfil do usuário autenticado
     */
    public function edit()
    {
        $user = Auth::user();
        
        return view('profile.edit', compact('user'));
    }

    /**
     * Atualiza o perfil do usuário autenticado
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validar os dados
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $user->id],
            'password' => ['nullable', 'confirmed', Password::min(8)],
        ]);

        // Remover is_admin se tentar enviar (usuários comuns não podem modificar)
        unset($validated['is_admin']);

        // Atualizar senha apenas se fornecida
        if (empty($validated['password'])) {
            unset($validated['password']);
        } else {
            $validated['password'] = Hash::make($validated['password']);
        }

        // Atualizar o usuário
        $user->update($validated);

        return redirect()->route('profile.edit')
            ->with('success', 'Perfil atualizado com sucesso!');
    }
}
