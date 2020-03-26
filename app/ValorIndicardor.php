<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ValorIndicardor extends Model
{
    public $timestamps = false;
    protected $table = 'DetalleSocial_has_indicadorSocial';
    protected $fillable =['indicadorSocial_id','DetalleSocial_id'];
}
