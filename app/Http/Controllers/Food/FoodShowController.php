<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Models\Food\Food;
use Exception;
use Illuminate\Http\Request;

class FoodShowController extends FoodController
{
    public function __invoke(Food $food)
    {
        try {

            // Lógica para obter os dados da receita a serem exibidos

            $response = [
                'food' => $food,
            ];

            return self::success('food.show', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao exibir receita', $exception);
        }
    }
}
