<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class indiceAdmision extends Model
{
    public $timestamps = false;
    protected $table = 'indiceadmision';
     protected $fillable = ['IDA','Especialidad_id','Periodo_id'];
}
