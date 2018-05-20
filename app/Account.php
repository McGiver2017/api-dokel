<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $primaryKey = 'user_id';
    protected $fillable = [
      'user_id',
      'enterprise_id',
      'cert',
      'logo',
      'credential_user',
      'credential_password',
    ];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function enterprise()
    {
        return $this->belongsTo('App\Enterprise');
    }
}
