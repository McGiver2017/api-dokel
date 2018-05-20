<?php

namespace App\Http\Resources\Empresa;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Office;
class UsarioListaEmpresaResource extends JsonResource
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
            'enterprise_id' => $this->enterprise->id,
            'ruc' => $this->enterprise->ruc,
            'razon_social' => $this->enterprise->razon_social,
            'comertial_name' => $this->enterprise->comertial_name,
            'cantidad_oficinas' => count(Office::where('enterprise_id',$this->enterprise->id)->get())
        ];
    }
}
