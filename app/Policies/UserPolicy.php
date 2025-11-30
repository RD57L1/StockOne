<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class UserPolicy
{
    /** REQUISITO: Administrador tem permissão total */
    public function before(User $user, string $ability): bool|null
    {
        if ($user->is_admin) {
            return true;
        }
        return null; // Deixa o controle para os métodos específicos
    }

    /** Permite que qualquer usuário autenticado veja o Resource (para que o filtro funcione). */
    public function viewAny(User $user): bool { return true; } 
    
    /** REQUISITO: Usuário comum só pode visualizar o próprio registro. */
    public function view(User $user, User $model): bool { return $user->id === $model->id; } 
    
    /** REQUISITO: Usuário comum só pode editar o próprio registro. */
    public function update(User $user, User $model): bool { return $user->id === $model->id; } 
    
    /** Nega criação e exclusão para usuários comuns. */
    public function create(User $user): bool { return false; } 
    public function delete(User $user, User $model): bool { return false; } 
    public function restore(User $user, User $model): bool { return false; } 
    public function forceDelete(User $user, User $model): bool { return false; }
}