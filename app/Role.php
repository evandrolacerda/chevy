<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $timestaps = false;
    
    public function processos()
    {
        return $this->belongsToMany(\App\Processo::class, 'roles_processos');
    }
}
