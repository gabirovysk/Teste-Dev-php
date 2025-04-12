<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (!Cliente::find(1)) {
            Cliente::create([
                'id' => 1,
                'nome' => 'zezinho do carmo',
                'cpf' => '33456789881',
                'email' =>'maildoze@email.com',
                'cep' =>'13450000',
                'endereco' => 'endereco de teste para mudanca'
            ]);
        }
        
    }
}
