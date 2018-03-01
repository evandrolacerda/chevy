<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Regiao extends Model
{
    protected $table = 'regioes';
    
    public $fillable = ['nome'];
}
