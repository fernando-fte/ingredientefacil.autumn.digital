<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use Exception;
use App\Http\Requests\Food\FoodStoreRequest;
use App\Models\Food\Food;
use Illuminate\Support\Facades\DB;

class FoodStoreController extends Controller
{
    public function __invoke(FoodStoreRequest $request)
    {
        try {

            DB::beginTransaction();

            # Cria a receita a partir do request
            $food = Food::createFromRequest($request);
            
            # Carrega o relacionamento 'preparation' junto com o model Food
            $food->load('preparation');

            DB::commit();

            $response = [
                'food' => $food,
            ];

            return self::success('food.store', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao armazenar receita', $exception);
        }
    }
}
