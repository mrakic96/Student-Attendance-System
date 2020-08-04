<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->belongsToMany('App\User');
    }

    public function attendances(){

        return $this->hasMany('App\Attendance');
    }
}
