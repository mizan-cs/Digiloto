<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function Organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
