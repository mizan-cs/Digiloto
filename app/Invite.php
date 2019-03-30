<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
