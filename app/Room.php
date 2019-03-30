<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function unseen_messages()
    {
        return $this->messages()->where('is_seen', false);
    }
}
