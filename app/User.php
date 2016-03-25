<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'gender'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /*
 * ROLES FUNCTIONALITY
 */
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_pluck($this->roles->toArray(), 'name'));
    }

    public function makeAdmin(){
        $admin_role = Role::where('name', 'admin')->first();
        $this->roles()->sync([$admin_role->id]);
    }

    public function makePatient(){
        $patient_role = Role::where('name', 'patient')->first();
        $this->roles()->sync([$patient_role->id]);
    }

    public function fullName(){
        return $this->first_name . ' ' . $this->last_name;
    }
}
