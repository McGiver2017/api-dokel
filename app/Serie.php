<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Serie extends Model
{
    protected $fillable = [
        'serie',
        'code_type_document',
        'type_document',
        'first'
    ];
}
