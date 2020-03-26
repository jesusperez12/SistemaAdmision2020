<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class cuposdiriginos extends Model
{
    public $timestamps = false;
    protected $table = 'cupos_dirigidos';
    protected $fillable =['id','Cupos','ModoIngreso_Id'];
}
