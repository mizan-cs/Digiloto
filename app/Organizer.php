<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
	protected $folder = 'images';

    protected $fillable = [
    	'title','email','logo','banner','details','is_approve','notice','user_id'
    ];


    public function user()
    {
        return $this->belongsTo(Organizer::class);
    }
    // public function getLogoAttribute($logo)
    // {
    // 	if ($this->logo != null) {
    // 		return asset($this->folder.'/'.$logo);	
    // 	}
    // 	return flase;
    // }

    // public function getBannerAttribute($banner)
    // {
    // 	if ($this->banner != null) {
    // 		return asset($this->folder.'/'.$banner);	
    // 	}
    // 	return flase;
    // }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function invites()
    {
        return $this->hasMany(Invite::class);
    }

    public function agents()
    {
        return $this->hasMany(Agent::class);
    }
}
