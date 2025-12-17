<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('preparations', function (Blueprint $table) {
            # ID único do modo de preparo
            $table->id();

            # ID do registro relacionado (receita, ingrediente, etc)
            $table->unsignedBigInteger('preparationable_id');

            # Tipo do modelo relacionado (ex: App\\Models\\Food, App\\Models\\Ingredient)
            $table->string('preparationable_type');

            # Ordem do passo de preparo (1, 2, 3...)
            $table->integer('step_order')->default(1);

            # Descrição/texto do passo de preparo
            $table->text('description');

            # Datas de criação/atualização
            $table->timestamps();

            # Índice para consultas polimórficas
            $table->index(['preparationable_id', 'preparationable_type'], 'preparation_polymorphic_idx');
        });
    }

    public function down()
    {
        Schema::dropIfExists('preparations');
    }
};
