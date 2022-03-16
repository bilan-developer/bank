<?php

namespace App\Http\Resources\Autocomplete;

use Illuminate\Http\Resources\Json\JsonResource;

class Currency extends JsonResource
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
            'code' => $this->code,
            'text' => sprintf('(%s) %s', $this->code, $this->name)
        ];
    }
}
