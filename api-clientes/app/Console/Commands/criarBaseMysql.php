<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use PDO;

class criarBaseMysql extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mysql:criar-base-mysql-projeto';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar a base do projeto mysql';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $nome_base = config("database.connections.mysql.database");
        $charset = config("database.connections.mysql.charset",'utf8mb4');
        $collation = config("database.connections.mysql.collation",'utf8mb4_general_ci');
        config(["database.connections.mysql.database" => null]);

        $query = "CREATE DATABASE IF NOT EXISTS $nome_base CHARACTER SET $charset COLLATE $collation;";
        DB::statement($query);

        config(["database.connections.mysql.database" => $nome_base]);
    }
}
