<?php

namespace App\Http\Resources\Course;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class History extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'rate' => $this->rate,
            'exchange_date' => Carbon::parse($this->exchangedate)->format('Y-m-d'),
            'difference' => $this->difference,
            'sign' => $this->sign,
        ];
    }
}
