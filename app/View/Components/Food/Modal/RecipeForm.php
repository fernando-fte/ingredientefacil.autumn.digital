<?php

namespace App\View\Components\Food\Modal;

use App\Models\Food\Food;
use Illuminate\View\Component;

class RecipeForm extends Component
{
    public $id;
    public $modalId;
    public $title;
    public $route;
    
    public $name;
    public $yield;
    public $unit;
    public $portions;
    public $preparation;

    /**
     * Create a new component instance.
     */
    public function __construct($title = 'Novo/Editar', ?Food $food = null, $modalId = null )
    {
        $this->title = $title;
        $this->modalId = $modalId ?? null;
        $this->route = $food ? route('web.food.update', ['food' => $food->id]) : route('web.food.store');
        
        $this->id = $food->id??'';
        $this->name = $food->title??'';
        $this->yield = $food->yield_value??'';
        $this->unit = $food->yield_unit??'';
        $this->portions = $food->portions??'';
        $this->preparation = $food->preparation->description??'';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render()
    {
        return view('components.food.modal.recipe-form');
    }
}
