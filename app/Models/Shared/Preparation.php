<?php

namespace App\Models\Shared;

use Illuminate\Database\Eloquent\Model;

class Preparation extends Model
{
    protected $table = 'preparations';
    protected $fillable = [
        'preparationable_id',
        'preparationable_type',
        'step_order',
        'description',
    ];

    /**
     * Relacionamento polimórfico reverso
     */
    public function preparationable()
    {
        return $this->morphTo();
    }
}
