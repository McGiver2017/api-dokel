<?php

namespace App\Http\Resources\Office;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Invoice;
class DatosOfficeResource extends JsonResource
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
            'serie_factura' => $this->serie_factura,
            'serie_boleta' => $this->serie_boleta,
            'cantidad_factura' => count(Invoice::where('office_transmitter_id', $this->id)->where('type_document_code', '01')->get()),
            'cantidad_boleta' => count(Invoice::where('office_transmitter_id', $this->id)->where('type_document_code', '03')->get())
        ];
    }
}
