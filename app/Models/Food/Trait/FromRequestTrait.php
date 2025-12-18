<?php

namespace App\Models\Food\Trait;

use App\Http\Requests\Food\FoodStoreRequest;
use App\Http\Requests\Food\FoodUpdateRequest;

trait FromRequestTrait
{
    public static function createFromRequest(FoodStoreRequest $request): self
    {
        $food = self::create([
            'title' => $request->input('title'),
            'yield_value' => $request->input('yield.value'),
            'yield_unit' => $request->input('yield.unit'),
            'portions' => $request->input('portions'),
        ]);

        // Cria um preparation único, se enviado
        if ($request->filled('preparation')) {
            $food->preparation()->create([
                'step_order' => 1,
                'description' => $request->input('preparation'),
            ]);
        }

        return $food;
    }

    public function updateFromRequest(FoodUpdateRequest $request): self
    {
        $this->update([
            'title' => $request->input('title'),
            'yield_value' => $request->input('yield.value'),
            'yield_unit' => $request->input('yield.unit'),
            'portions' => $request->input('portions'),
        ]);

        // Atualiza ou cria o preparation único, se enviado
        if ($request->filled('preparation')) {
            $this->preparation->description = $request->input('preparation');
            $this->preparation->save();
        }

        return $this;
    }
}
