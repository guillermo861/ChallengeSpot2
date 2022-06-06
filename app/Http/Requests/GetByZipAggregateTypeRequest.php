<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetByZipAggregateTypeRequest extends FormRequest
{
    /**
     * @return array
     */
    public function rules()
    {
        return [
            'construction_type' => 'required|integer|min:1|max:7'
        ];
    }
}
