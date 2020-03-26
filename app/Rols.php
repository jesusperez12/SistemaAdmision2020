<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rols extends Model
{
     // aqui esta listo
     protected $table = 'roles';

    protected $fillable =['id','name','slug','special','description'];  


    public function usuario() {

        return $this->belongsTo(User::class);
    
    }
 
}
