<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FoodStoreController extends Controller
{
    public function __invoke(Request $request)
    {
        try {

            dd($request->all());

            // Lógica para obter os dados da receita a serem exibidos

            $response = [
                // Dados da receita a serem exibidos
            ];

            return self::success('food.store', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao armazenar receita', $exception);
        }
    }
}
