<?php

namespace App\Console\Commands;

use App\Models\Restaurante;
use Illuminate\Console\Command;

class CreateTestRestaurante extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'restaurante:create-test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cria um restaurante de teste para login';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Verificar se já existe um restaurante com esse email
        $restaurante = Restaurante::where('email', 'teste@restaurante.com')->first();
        
        if (!$restaurante) {
            // Criar novo restaurante com CNPJ único
            $restaurante = Restaurante::create([
                'nome' => 'Restaurante Teste',
                'cnpj' => '98.765.432/0001-10',
                'endereco' => 'Rua Teste, 123 - Centro',
                'telefone' => '(11) 99999-9999',
                'email' => 'teste@restaurante.com',
                'status' => 'ativo',
            ]);
        } else {
            // Atualizar restaurante existente
            $restaurante->update([
                'nome' => 'Restaurante Teste',
                'endereco' => 'Rua Teste, 123 - Centro',
                'telefone' => '(11) 99999-9999',
                'status' => 'ativo',
            ]);
        }

        $this->info('✅ Restaurante criado/atualizado com sucesso!');
        $this->newLine();
        $this->info('📧 Email: ' . $restaurante->email);
        $this->info('📄 CNPJ: ' . $restaurante->cnpj);
        $this->info('🏢 Nome: ' . $restaurante->nome);
        $this->newLine();
        $this->info('🔐 Use essas credenciais para fazer login em: http://127.0.0.1:8000/login');

        return Command::SUCCESS;
    }
}
