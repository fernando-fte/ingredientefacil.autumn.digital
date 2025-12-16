<?php

namespace App\Http\Controllers\Food;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FoodCreateController extends Controller
{
    public function __invoke(Request $request)
    {
        // Futuramente: lógica para exibir formulário de criação de receita
        return view('food.create');
    }
}
