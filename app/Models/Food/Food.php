<?php

namespace App\Models\Food;

use App\Models\Food\Trait\FromRequestTrait;
use App\Models\Shared\Preparation;
use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    use FromRequestTrait;
    
    protected $table = 'foods';
    protected $fillable = [
        'title',
        'yield_value',
        'yield_unit',
        'portions',
    ];

    /**
     * Relacionamento: modo de preparo único (polimórfico)
     */
    public function preparation()
    {
        return $this->morphOne(Preparation::class, 'preparationable');
    }
}
