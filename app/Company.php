<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
	 protected $fillable = [
        'name', 'email', 'address','tel','domain'
    ];

   public function users()
    {
        return $this->hasMany('App\User');
    }
}
