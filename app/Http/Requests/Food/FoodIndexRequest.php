<?php

namespace App\Http\Requests\Food;

use App\Http\Requests\Food\FoodRequest;

class FoodIndexRequest extends FoodRequest
{
    // No futuro, adicione regras de pesquisa aqui
    public function rules()
    {
        return [];
    }
}
