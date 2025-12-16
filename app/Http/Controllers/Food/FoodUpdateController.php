<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class FoodUpdateController extends Controller
{
    public function __invoke(Request $request, $food)
    {
        try {

            // Lógica para obter os dados da receita a serem exibidos

            $response = [
                // Dados da receita a serem exibidos
            ];

            return self::back()::success('', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao atualizar receita', $exception);
        }
    }
}
