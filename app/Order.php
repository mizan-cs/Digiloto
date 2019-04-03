<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function referredBy()
    {
        return $this->belongsTo(Agent::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    public function isExpire()
    {
        return Carbon::parse($this->expire_at)->isPast();
    }
}
