<?php

namespace App\Http\Requests\Food;

class FoodStoreRequest extends FoodRequest
{
    public function rules()
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'rendimento_valor' => ['required', 'numeric', 'min:0.01'],
            'rendimento_unidade' => ['required', 'string'],
            'porcoes' => ['required', 'integer', 'min:1'],
            'modo_preparo' => ['nullable', 'string'],
        ];
    }
}
