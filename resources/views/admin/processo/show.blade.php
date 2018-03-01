@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/processo">Processos</a></li>
    <li><a href="#">Processo</a></li>
</ol>

<div class="panel panel-primary">
    <div class="panel-heading">Processo</div>
    <div class="panel-body">
        <h1>{{$processo->nome}}</h1>
        <hr>
        <p>
            <strong>Objetivo:</strong>
            {{$processo->objetivo}}
        </p>

        <p>
            <strong>Ação:</strong>
            {{$processo->acao}}
        </p>
        <hr>
        <p>
            <strong>Quando:</strong>
            {{$processo->quando}}
        </p>
        <p>
            <strong>Método de Verificação:</strong>
            {{$processo->metodo_verificacao}}
        </p>
        
            <strong>Quem Participa:</strong>
            <br>
            <br>
            <ul class="list-group">

            @foreach($processo->roles as $role )
            <li class="list-group-item">{{$role->nome}} - Pontos: {{$role->pivot->pontos}}</li>
            @endforeach
        </ul>
    </div>
</div>

@endsection

