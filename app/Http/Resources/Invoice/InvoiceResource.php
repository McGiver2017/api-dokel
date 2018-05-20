<?php

namespace App\Http\Resources\Invoice;

use Illuminate\Http\Resources\Json\JsonResource;

class InvoiceResource extends JsonResource
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
            'documento_serie' => $this->serie,
            'documento_tipoDoc' => $this->type_document->description,
            'cliente' => $this->office_receiver->enterprise->ruc,
            'documento_fechaEmision' => $this->documento_fechaEmision,
            'documento_correlativo' => $this->documento_correlativo,
            'venta_tipoDeMoneda' => $this->venta_tipoDeMoneda,
            'estado' => 'no definido'
        ];
    }
}
