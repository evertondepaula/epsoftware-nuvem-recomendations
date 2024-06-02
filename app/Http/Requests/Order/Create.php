<?php

namespace Nuvem\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'number'             => 'required|integer',
            'created_at'         => 'required|date_format:"Y-m-d H:i:s"',
            'items'              => 'required|array',
            'items.*.sku'        => 'required|string',
            'items.*.name'       => 'required|string',
            'items.*.quantity'   => 'required|integer|min:1',
            'items.*.unit_value' => 'required|numeric|min:0',
            'items.*.created_at' => 'required|date_format:"Y-m-d H:i:s"',
        ];
    }
}
