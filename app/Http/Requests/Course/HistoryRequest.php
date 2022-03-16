<?php

namespace App\Http\Requests\Course;

use App\Http\Requests\BaseRequest;

class HistoryRequest extends BaseRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'date_from' => 'required|date_format:Y-m-d',
            'date_to' => 'required|date_format:Y-m-d',
            'currency' => 'required|string|size:3'
        ];
    }
}
