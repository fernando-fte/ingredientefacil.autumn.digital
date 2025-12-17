<?php

namespace App\Models\Food;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Food extends Model
{
    protected $table = 'foods';
    protected $fillable = [
        'title',
        'yield_value',
        'yield_unit',
        'portions',
    ];

    /**
     * Relacionamento: modos de preparo (polimórfico)
     */
    public function preparations(): MorphMany
    {
        return $this->morphMany(\App\Models\Shared\Preparation::class, 'preparationable');
    }
}
