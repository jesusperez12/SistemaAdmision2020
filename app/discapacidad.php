<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class discapacidad extends Model
{
    public $timestamps = false;
    protected $table = 'discapacidades';

    protected $fillable =['id','discapacidad']; 



    public function Aspirante()
    {
        return $this->hasMany(Datosaspirante::class);
    }



}
