<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class type_notes_credit_debit extends Model
{
    protected $primaryKey = 'code';
    protected $fillable = [
        'code',
        'type_document_code',
        'description'
    ];
}
