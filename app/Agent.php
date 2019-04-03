<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }

    public function getMyLink(Game $game)
    {
        return route('games.show',$game).'/'.$this->token;
    }
}
