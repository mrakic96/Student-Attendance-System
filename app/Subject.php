<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
    ];

    /* Veze sa drugim modelima
    *   @User
    *   @Attendance
    */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function attendances(){

        return $this->hasMany('App\Attendance');
    }
    /*------------------------------------------*/
}
