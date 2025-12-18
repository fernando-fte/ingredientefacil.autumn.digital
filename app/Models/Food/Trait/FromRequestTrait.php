<?php

namespace App\Models\Food\Trait;

use App\Http\Requests\Food\FoodStoreRequest;

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

    public function updateFromRequest(FoodStoreRequest $request): self
    {
        $this->update([
            'title' => $request->input('title'),
            'yield_value' => $request->input('yield.value'),
            'yield_unit' => $request->input('yield.unit'),
            'portions' => $request->input('portions'),
        ]);

        return $this;
    }
}
