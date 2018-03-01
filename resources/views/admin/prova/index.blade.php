@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/prova">Prova</a></li>
    
</ol>
<h1>Provas</h1>
<hr>
<div class="panel-body">
    <a href="/admin/prova/create" class="btn btn-success btn-sm pull-right">
        <i class="fa fa-plus"></i>
        Registrar nova Prova
    </a>
</div>
<div class="panel panel-success">
    <div class="panel-heading">
        Provas
    </div>
    <div class="panel-body">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Prova</th>
                    <th>Mês</th>
                    <th>Ano</th>
                    <th>Questões</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $provas as $prova )
                <tr>
                    <td>{{$prova->id}}</td>
                    <td>{{$prova->mes}}</td>
                    <td>{{$prova->ano}}</td>
                    
                    <td>
                        <a href="/admin/prova/{{$prova->id}}" class="btn btn-success btn-sm">
                            <i class="fa fa-clipboard"></i>
                            Questões
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
