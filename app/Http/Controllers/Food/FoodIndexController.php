<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\FoodIndexRequest;
use App\Models\Food\Food;
use Exception;
use Illuminate\Http\Request;

class FoodIndexController extends FoodController
{
    public function __invoke(FoodIndexRequest $request)
    {
        try {

            $foods = Food::all();

            $response = [
                'foods' => $foods,
            ];

            return self::success('food.index', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao exibir receita', $exception);
        }
    }
}
