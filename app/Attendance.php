<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    protected $fillable = [
        'description', 'date', 'subject_id',
    ];

    public function subject(){

        return $this->belongsTo('App\Subject');
    }

    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
