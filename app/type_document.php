<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_document extends Model
{
    protected $primaryKey = 'code';
    protected $fillable = [
        'code',
        'description'
    ];
}
