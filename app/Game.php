<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

	protected $guarded = [

    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function tickets()
    {

        return $this->hasMany(Ticket::class);
    }

    public function scopeOfActive($query)
    {
        return $query->where('is_active',true )->where('is_approve',true)->where('is_private',false);
    }


    public function isFinish()
    {
        return Carbon::create($this->start_at)->isPast();
    }

    public function agent()
    {
        return $this->belongsTo(Agent::class);
    }
}
