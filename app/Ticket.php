<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $guarded = [

    ];

    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
