<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FoodIndexController extends FoodController
{
    public function __invoke(Request $request)
    {
        try {

            // Lógica para obter os dados da receita a serem exibidos

            $response = [
                // Dados da receita a serem exibidos
            ];

            return self::success('food.index', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao exibir receita', $exception);
        }
    }
}
