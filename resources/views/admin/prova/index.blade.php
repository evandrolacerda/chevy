@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Treinamento</a></li>
    <li><a href="#">Prova</a></li>
    <li><a href="#">Create</a></li>
</ol>
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
                    <th>Aplicações</th>
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
                    <td>
                        <a href="#" class="btn btn-success btn-sm">
                            <i class="fa fa-clipboard"></i>
                            Ver Aplicações
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


@endsection
