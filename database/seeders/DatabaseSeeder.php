<?php

namespace Database\Seeders;

use App\Models\Restaurante;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // Criar usuário administrador
        User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@stockone.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
        ]);

        // Criar usuário comum de exemplo
        User::factory()->create([
            'name' => 'Usuário Comum',
            'email' => 'user@stockone.com',
            'password' => bcrypt('password'),
            'is_admin' => false,
        ]);

        // Criar restaurante de exemplo para acesso
        Restaurante::firstOrCreate(
            ['email' => 'admin@stockone.com'],
            [
                'nome' => 'Restaurante Exemplo',
                'cnpj' => '12.345.678/0001-90',
                'endereco' => 'Rua Exemplo, 123 - Centro',
                'telefone' => '(11) 99999-9999',
                'email' => 'admin@stockone.com',
                'status' => 'ativo',
            ]
        );
    }
}
