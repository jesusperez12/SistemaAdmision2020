<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
     protected $table = 'Pais';
    protected $fillable =['id','Pais'];

      public function estado() {

    	return $this->hasMany(Estado::class);
    }

}
