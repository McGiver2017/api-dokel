<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_affectation_igv extends Model
{
    protected $primaryKey = 'code';
    protected $fillable = [
        'code',
        'description'
    ];
}
