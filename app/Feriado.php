<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Feriado extends Model
{
    const FERIADO_NACIONAL = 1;
    const FERIADO_ESTADUAL = 2;
    const FERIADO_MUNICIPAL = 3;
    const FERIADO_PONTO_FACULTATIVO = 4;

    const TIPOS_FERIADOS = [
        self::FERIADO_NACIONAL => 'Feriado Nacional',
        self::FERIADO_ESTADUAL => 'Feriado Estadual',
        self::FERIADO_MUNICIPAL => 'Feriado Municipal',
        self::FERIADO_PONTO_FACULTATIVO => 'Ponto Facultativo',
    ];


    public $fillable = [
        'nome',
        'tipo',
        'codigo_tipo',
        'data'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'data'
    ];
}
