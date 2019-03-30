<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends \TCG\Voyager\Models\User
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','is_operator','is_active'
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


    public function organizers()
    {
        return $this->hasMany(Organizer::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function isOperator()
    {
        if ($this->is_operator) {
            return true;
        }
        else{
            return false;
        }
    }

    public function isAgent()
    {
        if ($this->is_agent) {
            return true;
        }
        else{
            return false;
        }
    }

    public function agent()
    {
        return $this->hasOne(Agent::class);
    }

}
