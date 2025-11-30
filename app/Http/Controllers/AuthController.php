<?php

namespace App\Http\Controllers;

use App\Models\Restaurante;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session()->has('restaurante_id')) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email'],
            'cnpj' => ['required', 'string', 'max:18'],
        ]);

        // Normalizar CNPJ removendo formatação (pontos, barras e hífens)
        $cnpjNormalizado = preg_replace('/[^0-9]/', '', $data['cnpj']);

        // Buscar restaurante por email e status
        $restaurantes = Restaurante::query()
            ->where('email', $data['email'])
            ->where('status', 'ativo')
            ->get();

        // Comparar CNPJ normalizado
        $restaurante = $restaurantes->first(function ($restaurante) use ($cnpjNormalizado) {
            // Normalizar CNPJ do banco para comparação
            $cnpjBanco = preg_replace('/[^0-9]/', '', $restaurante->cnpj ?? '');
            return $cnpjBanco === $cnpjNormalizado;
        });

        if (!$restaurante) {
            return back()->withErrors([
                'email' => 'Credenciais inválidas ou restaurante inativo.',
            ])->onlyInput('email');
        }

        $request->session()->put('restaurante_id', $restaurante->id);
        $request->session()->put('restaurante_nome', $restaurante->nome);
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }

    public function logout(Request $request)
    {
        $request->session()->forget(['restaurante_id', 'restaurante_nome']);
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Sessão encerrada.');
    }
}
