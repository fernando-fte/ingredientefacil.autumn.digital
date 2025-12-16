<?php

namespace App\Http\Controllers\Food\Cost;

use Exception;
use Illuminate\Http\Request;

class FoodCostStoreController extends FoodCostController
{
    public function __invoke(Request $request)
    {
        try {

            // Lógica para obter os dados a serem exibidos

            $response = [
                // Dados a serem exibidos
            ];

            return self::back()::success('', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao armazenar custo operacional', $exception);
        }
    }
}
