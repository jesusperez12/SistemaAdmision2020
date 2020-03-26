<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
	  public $timestamps = false;
      protected $table = 'Periodo';

    protected $fillable =['NombrePeriodo','Lapso','Resolucion','Vigente'];    
}