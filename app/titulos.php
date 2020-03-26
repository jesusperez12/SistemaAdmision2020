<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class titulos extends Model
{
	 public $timestamps = false;
	 protected $table = 'TiposTitulos';
     protected $fillable = ['TiposTitulo'];
}
