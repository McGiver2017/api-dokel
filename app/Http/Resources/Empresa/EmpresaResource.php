<?php

namespace App\Http\Resources\Empresa;

use Illuminate\Http\Resources\Json\JsonResource;

class EmpresaResource extends JsonResource
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
            'id' => $this->id,
            'cod_identification' => $this->identification->code,
            'name_identification' => $this->identification->description,
            'ruc' => $this->ruc,
            'comertial_name' => $this->comertial_name,
            'razon_social' => $this->razon_social

        ];
    }
}
