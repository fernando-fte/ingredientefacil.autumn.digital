<?php

namespace App\Http\Controllers\Food\Ingredient;

use Exception;
use Illuminate\Http\Request;

class FoodIngredientStoreController extends FoodIngredientController
{
    public function __invoke(Request $request)
    {
        try {

            // Lógica para obter os dados da receita a serem exibidos

            $response = [
                // Dados da receita a serem exibidos
            ];

            return self::back()::success('', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao armazenar ingrediente da receita', $exception);
        }
    }
}
