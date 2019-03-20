<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{

	protected $guarded = [

    ];

    public function organizer()
    {
        return $this->belongsTo(Organizer::class);
    }
}
