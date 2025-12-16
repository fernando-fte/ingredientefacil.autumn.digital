<?php

namespace App\Http\Controllers\Food\Cost;

use Exception;
use Illuminate\Http\Request;

class FoodCostUpdateController extends FoodCostController
{
    public function __invoke(Request $request, $food, $cost)
    {
        try {

            // Lógica para obter os dados a serem exibidos

            $response = [
                // Dados a serem exibidos
            ];

            return self::back()::success('', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao atualizar custo operacional', $exception);
        }
    }
}
