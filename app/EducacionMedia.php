<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EducacionMedia extends Model
{
    public $timestamps = false;
    protected $table = 'RamasEducacionMedia';
    protected $fillable =['ramas'];
}
