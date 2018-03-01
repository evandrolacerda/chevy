<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HotlistProcessamento extends Model
{
    public function user()
    {
        return $this->belongsTo(\App\User::class);
    }
            
}
