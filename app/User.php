<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
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
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Veza sa modelom Role
    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function subjects()
    {
        return $this->belongsToMany('App\Subject');
    }

    // F-ja provjerava ima li neki user više uloga
    public function hasAnyRoles($roles)
    {
        if($this->roles()->whereIn('name', $roles)->first()){
            return true;
        }

        return false;
    }

    // F-ja provjerava ima li neki user određenu ulogu
    public function hasRole($role)
    {   
        if($this->roles()->where('name', $role)->first()){
            return true;
        }

        return false;
    }

    // F-ja provjerava ima li neki user više kolegija
    public function hasAnySubjects($subjects)
    {
        if($this->subjects()->whereIn('name', $subjects)->first()){
            return true;
        }

        return false;
    }

    // F-ja provjerava ima li neki user određeni kolegij
    public function hasSubject($subject)
    {   
        if($this->subjects()->where('name', $subject)->first()){
            return true;
        }

        return false;
    }
}
