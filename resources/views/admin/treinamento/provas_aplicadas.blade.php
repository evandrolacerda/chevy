@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
  <li><a href="/admin">Admin</a></li>
  <li><a href="/admin/provas-aplicas">Provas Aplicadas</a></li>
</ol>

<h2>Provas Aplicadas</h2>

<table class="table table-bordered">
    <tr>
        <td>#</td>
        <td>Colaborador</td>
        <td>Prova do Mês</td>
        <td>Prova do Ano</td>
        <td>Ver Prova</td>
        <td>Invalidar</td>
    </tr>
    @foreach( $provas as $pr)
    <tr>
        <td>{{$pr->id}}</td>
        <td>{{$pr->user->name}}</td>
        <td>{{$pr->prova->mes}}</td>
        <td>{{$pr->prova->ano}}</td>
        <td>
            <a href="/admin/provas-aplicadas/{{$pr->id}}" class="btn btn-success btn-xs">
                <i class="fa fa-eye"></i>
                Prova
            </a>
        </td>
        <td>
            <a href="/admin/processo/invalidar/5/{{$pr->user->id}}/{{$pr->prova->mes}}/{{$pr->prova->ano}}" class="btn btn-danger btn-xs">
                <i class="fa fa-ban"></i>
                Invalidar
            </a>
        </td>
    </tr>
    @endforeach
</table>

@endsection
