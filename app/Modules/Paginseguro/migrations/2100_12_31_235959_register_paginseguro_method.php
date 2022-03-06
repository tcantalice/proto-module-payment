<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use PHPUnit\TextUI\XmlConfiguration\MigrationException;

class RegisterPagInSeguroMethod extends Migration
{
    public function up()
    {
        if (Schema::hasTable('metodo_pagamento')) {
            DB::table('metodo_pagamento')->insert([
                'descricao' => 'PagInSeguro',
                'nome' => 'paginseguro',
            ]);
        } else {
            throw new MigrationException('Tabela "metodo_pagamento" não encontrada. Verifique se a tabela já foi migrada');
        }
    }

    public function down()
    {
        if (Schema::hasTable('metodo_pagamento')) {
            DB::table('metodo_pagamento')->where('nome', 'paginseguro')
                ->delete();
        }
    }
}