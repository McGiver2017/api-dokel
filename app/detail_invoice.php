<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class detail_invoice extends Model
{
    protected $fillable = [
        'invoice_id',
        'code_product',
        'unity' ,
        'quantity' ,
        'description',
        'type_affectation_igv_code',
        'igv',
        'AmountValueSale',
        'amountValueUnit',
        'AmountPriceUnit'
    ];
    public function type_affectation_igv()
    {
        return $this->belongsTo('App\type_affectation_igv');
    }
}
