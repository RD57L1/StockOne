<?php

namespace App\Console\Commands;

use App\Models\Restaurante;
use Illuminate\Console\Command;

class CreateRestauranteCommand extends Command
{
    protected $signature = 'restaurante:create {--check}';
    protected $description = 'Cria ou verifica o restaurante de exemplo';

    public function handle()
    {
        $email = 'admin@stockone.com';
        $restaurante = Restaurante::where('email', $email)->first();

        if ($restaurante) {
            $this->info('Restaurante já existe:');
            $this->line('Nome: ' . $restaurante->nome);
            $this->line('Email: ' . $restaurante->email);
            $this->line('CNPJ: ' . $restaurante->cnpj);
            $this->line('Status: ' . $restaurante->status);
        } else {
            $restaurante = Restaurante::create([
                'nome' => 'Restaurante Exemplo',
                'cnpj' => '12.345.678/0001-90',
                'endereco' => 'Rua Exemplo, 123 - Centro',
                'telefone' => '(11) 99999-9999',
                'email' => $email,
                'status' => 'ativo',
            ]);

            $this->info('Restaurante criado com sucesso!');
            $this->line('Email: ' . $restaurante->email);
            $this->line('CNPJ: ' . $restaurante->cnpj);
        }

        return 0;
    }
}

