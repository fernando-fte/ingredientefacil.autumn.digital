<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use App\Http\Requests\Food\FoodUpdateRequest;
use App\Models\Food\Food;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FoodUpdateController extends Controller
{
    public function __invoke(FoodUpdateRequest $request, Food $food)
    {
        try {

            DB::beginTransaction();

            # Cria a receita a partir do request
            $food->updateFromRequest($request);
            
            # Carrega o relacionamento 'preparation' junto com o model Food
            $food->load('preparation');

            DB::commit();

            $response = [
                'food' => $food,
            ];

            return self::back()::success('', $response);
        } catch (Exception $exception) {
            return self::fatal('Erro ao atualizar receita', $exception);
        }
    }
}
