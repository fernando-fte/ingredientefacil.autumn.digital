<?php

namespace App\Http\Requests\Food;

use App\Http\Requests\BaseRequest;

class FoodRequest extends BaseRequest
{

    public function messages()
    {
        return [
            // Nome
            'nome.required' => 'O nome da receita é obrigatório.',
            'nome.string' => 'O nome da receita deve ser um texto.',
            'nome.max' => 'O nome da receita não pode ter mais que 255 caracteres.',

            // Rendimento valor
            'rendimento_valor.required' => 'O rendimento é obrigatório.',
            'rendimento_valor.numeric' => 'O rendimento deve ser um número.',
            'rendimento_valor.min' => 'O rendimento deve ser maior que zero.',

            // Rendimento unidade
            'rendimento_unidade.required' => 'A unidade do rendimento é obrigatória.',
            'rendimento_unidade.string' => 'A unidade do rendimento deve ser um texto.',

            // Porções
            'porcoes.required' => 'O número de porções é obrigatório.',
            'porcoes.integer' => 'O número de porções deve ser um número inteiro.',
            'porcoes.min' => 'O número de porções deve ser pelo menos 1.',

            // Modo de preparo
            'modo_preparo.string' => 'O modo de preparo deve ser um texto.',
        ];
    }
}
