<?php

namespace App\Http\Requests\Course;

use App\Http\Requests\BaseRequest;

class ConvertRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric',
            'currency' => 'required|string|size:3'
        ];
    }
}
