<?php

namespace App;
use App\Role;

use Illuminate\Database\Eloquent\Model;

class Processo extends Model
{
    public $timestamps = false;
    
    public function roles() {
        return $this->belongsToMany(Role::class, 'roles_processos')
                ->withPivot('pontos');
    }
    
    
    
}
