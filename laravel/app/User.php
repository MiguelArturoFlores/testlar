<?php

namespace testmiguel;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'lastname','cellphone','country','country_state',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'storeuser';


    //RELATIONS
    public function orders()
    {
        return $this->hasMany('testmiguel\Order');
    }
}
