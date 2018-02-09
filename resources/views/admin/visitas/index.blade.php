@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/visitas">Visitas</a></li>
</ol>
<div class="col-md-12">

    <form class="navbar-form navbar-right">
        <div class="form-group">
            <select name="mes" class="form-control">
                <option value="1">Janeiro</option>
                <option value="2">Fevereiro</option>
                <option value="3">Março</option>
                <option value="4">Abril</option>
                <option value="5">Maio</option>
                <option value="6">Junho</option>
                <option value="7">Julho</option>
                <option value="8">Agosto</option>
                <option value="9">Setembro</option>
                <option value="10">Outubro</option>
                <option value="11">Novembro</option>
                <option value="12">Dezembro</option>
            </select>
        </div>
        <div class="form-group">
            <select name="ano" class="form-control col-md-6 col-sm-6">
                <option value="2018">2018</option>
                <option value="2018">2019</option>
                <option value="2019">2020</option>
                <option value="2021">2021</option>
            </select>  
        </div>
        <button type="submit" class="btn btn-primary">Buscar</button>
    </form>
    
</div>
<br>
<h1>Envios do Processo P2 - Visitas</h1>
<hr>
@foreach( $albums as $album )
<div class="col-md-6">
    <div class="panel panel-success">
        <div class="panel-heading text-center"><strong>{{$album->user->name}}</strong></div>
        <div class="panel-body">
            <p>Funcão: {{$album->user->role->nome}}</p>
            <p>Mês: {{$album->getMes()}}/{{$album->getAno()}}</p>
            <p>Quantidade de Fotos Enviadas: {{$album->getCountFotos()}}</p>
        </div>
        <div class="panel-footer">
            <a href="/admin/album/{{$album->user->id}}/{{$album->getMes()}}/{{$album->getAno()}}"
               class="btn btn-success btn-block btn-sm">
                <span class="glyphicon glyphicon-picture"></span>
                Ver Fotos
            </a>
        </div>
    </div>    
</div>

@endforeach

@endsection
