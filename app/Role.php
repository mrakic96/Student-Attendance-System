<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /* Veze sa drugim modelima
    *   @User
    */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
    /*------------------------------------*/
}
