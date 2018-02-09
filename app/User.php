<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'chefia_id',
        'cpf', 'regiao', 'cep', 'rua', 'numero', 'bairro', 'cidade',
        'estado', 'telefone', 'celular'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'cpf'
    ];
    
    public function role() {
        return $this->belongsTo(\App\Role::class);
    }
    
    public function faixas() {
        return $this->belongsToMany(\App\Faixa::class, 'users_faixas');
    }
    
    public function regiao() {
        return $this->belongsTo(\App\Regiao::class);
    }
}
