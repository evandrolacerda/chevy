@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Processos</a></li>
</ol>

<div class="panel panel-success">
    <div class="panel-heading">Processos</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Processo</th>
                        <th>Objetivo</th>
                        <th>Ver Cadastro</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($processos as $processo)
                    <tr>
                        <td>{{$processo->id}}</td>
                        <td>{{$processo->nome}}</td>
                        <td>{{$processo->objetivo}}</td>
                        <td>
                            <a href="/admin/processo/{{$processo->id}}" class="btn btn-success btn-xs">
                                <i class="fa fa-eye"></i>
                                Ver Processo
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
