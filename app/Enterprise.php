<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enterprise extends Model
{
    protected $fillable = [
        'identification_code',
        'ruc',
        'comertial_name',
        'razon_social'
    ];
    public function identification()
    {
        return $this->belongsTo('App\Identification');
    }
}
