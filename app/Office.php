<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Office extends Model
{
    protected $fillable = [
        'enterprise_id',
        'direction',
        'cod_postal',
        'departament',
        'province',
        'district'
    ];
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
