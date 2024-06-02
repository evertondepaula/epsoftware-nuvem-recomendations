<?php

namespace Nuvem\Http\Requests\Recomendation;

use Illuminate\Foundation\Http\FormRequest;

class Get extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get Rules
     * @return array
     */
    public function rules()
    {
        return [
            'months' => 'nullable|integer|min:2|max:12',
            'limit'  => 'nullable|integer|min:1|max:10',
        ];
    }
}
