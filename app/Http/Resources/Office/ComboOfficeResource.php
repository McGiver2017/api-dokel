<?php

namespace App\Http\Resources\Office;

use Illuminate\Http\Resources\Json\JsonResource;

class ComboOfficeResource extends JsonResource
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
            'value' => $this->id,
            'text' => $this->direction
        ];
    }
}
