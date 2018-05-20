<?php

namespace App\Http\Resources\SelectCombo;

use Illuminate\Http\Resources\Json\JsonResource;

class TipIgvComboResource extends JsonResource
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
            'value' => $this->code,
            'text' => $this->description
        ];
    }
}
