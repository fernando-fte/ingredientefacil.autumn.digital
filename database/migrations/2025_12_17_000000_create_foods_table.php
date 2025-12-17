<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            # ID único da receita
            $table->id();

            # Nome/título da receita
            $table->string('title');

            # Quantidade total produzida (ex: 1.0)
            $table->decimal('yield_value', 10, 2);

            # Unidade do rendimento (ex: kg, g, l, un)
            $table->string('yield_unit', 10);

            # Quantidade de porções
            $table->integer('portions');

            # Datas de criação/atualização
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('foods');
    }
};
