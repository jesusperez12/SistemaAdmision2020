<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RolsUserid extends Model
{
    // aqui esta listo
    protected $table = 'role_user';

    protected $fillable =['id','role_id','user_id'];  


    public function usuario() {

        return $this->belongsTo(User::class);
    
    }

}
