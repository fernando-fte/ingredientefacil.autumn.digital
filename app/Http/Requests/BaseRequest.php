<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

abstract class BaseRequest extends FormRequest
{
    public function authorize()
    {
        // Permite customização futura de autorização
        return true;
    }
}
