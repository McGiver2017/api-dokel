<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identification extends Model
{
    protected $primaryKey = 'code';
    protected $fillable = [
        'code',
        'description'
    ];
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
