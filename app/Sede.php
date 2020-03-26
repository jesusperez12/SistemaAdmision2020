<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sede extends Model
{
    protected $table = 'sede';

    protected $fillable =['id_sede','NombSede'];   



  public function users() {

	return $this->hasMany(User::class, 'sede_id', 'id_sede');

}

public function admins() {

	return $this->hasMany(admins::class, 'sede_id', 'id_sede');

}

public function nucleos()
{
   return $this->hasMany(InstitutoUser::class);
}


        
}