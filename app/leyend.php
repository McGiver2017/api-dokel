<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class leyend extends Model
{
    protected $primaryKey = 'code';
    protected $fillable = [
        'code',
        'description'
    ];
}
