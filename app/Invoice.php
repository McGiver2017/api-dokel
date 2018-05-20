<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{

    protected $fillable = [
        'user_id',
        'office_transmitter_id',
        'office_receiver_id',
        'type_document_code',
        'documento_correlativo',
        'documento_fechaEmision',
        'venta_igv',
        'serie',
        'venta_opExonerados',
        'venta_precioVenta',
        'venta_descuentoOpGravadas',
        'venta_opGravadas',
        'venta_opNoOnerosas',
        'venta_valorDescuento',
        'venta_tipoDeMoneda'
    ];

    public function office_transmitter()
    {
        return $this->belongsTo('App\Office');
    }
    public function office_receiver()
    {
        return $this->belongsTo('App\Office');
    }
    public function type_document()
    {
        return $this->belongsTo('App\type_document');
    }
    public function serie()
    {
        return $this->belongsTo(Serie::class);
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
