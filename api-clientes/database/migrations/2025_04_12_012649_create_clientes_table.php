<?php

use Database\Seeders\ClienteSeeder;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {

        if (!Schema::hasTable('clientes')) {

            Schema::create('clientes', function (Blueprint $table) {
                $table->id();
                $table->string('nome', 250);
                $table->string('cpf',11);
                $table->string('email', 250);
                $table->string('cep',8);
                $table->string('endereco');
                $table->timestamps();
            });
        }


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
