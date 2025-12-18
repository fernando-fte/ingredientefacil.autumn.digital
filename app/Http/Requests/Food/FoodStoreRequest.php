<?php

namespace App\Http\Requests\Food;

class FoodStoreRequest extends FoodRequest
{
    public function rules()
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'yield.value' => ['required', 'numeric', 'min:0.01'],
            'yield.unit' => ['required', 'string'],
            'portions' => ['required', 'integer', 'min:1'],
            'preparation' => ['nullable', 'string'],
        ];
    }
}
