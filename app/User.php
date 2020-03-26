<?php

namespace App;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Notifications\Notifiable;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, ShinobiTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','Apellidos','cedula','email', 'password','sede_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sede() {

        return $this->belongsTo(Sede::class, 'sede_id', 'id_sede');
    
    }
        /* public function rol() {
    
        return $this->belongsTo(Rols::class, 'rols_id', 'id_rols');
    
         }*/

         public function getRolId()
         {
             if ($this->roles->isNotEmpty())
             {
                return $this->roles->first()->id;
             }
         }
         
           /**
          * Devuelve el nombre del rol
          *
          * @return string
          */
         public function getRolNombre()
         {
             if ($this->roles->isNotEmpty())
             {
                 return $this->roles->first()->name;
             }
         }





            
             public function oferta()
    {
       return $this->belongsTo(oferta::class);
    }
    
    
         public function nucleo(){
            return $this->belongsTo(InstitutoUser::class);
        }
    
        public function institutos() {
    
        return $this->hasMany(sedeInstitutos::class);
    
    }

    public function rols() {
    
        return $this->hasMany(RolsUserid::class);
    
    }
    
        /**Class 'App\ResetPasswordNotification' not found
         * Metodos perfecto, tienes alguna idea para evitar que cargue asi la pagina?? la lentitud? si muestra tu layoutok
         */
    
        public function getSede() {
            return ! is_null($this->sede) ? $this->sede->NombSede : '';
        }
    
        public function getRol() {
            return ! is_null($this->rols) ? $this->role_user->role_id : '';
        }
    
    
     public function sendPasswordResetNotification($token)
        {
            $this->notify(new ResetPasswordNotification($token));
        }




}
