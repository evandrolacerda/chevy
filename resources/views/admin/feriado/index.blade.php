@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/feriados/">Feriado</a></li>
</ol>

<div class="table-responsive">
        <div class="panel-body">
                <a href="/admin/feriados/create" class="btn btn-success btn-sm pull-right">
                    <i class="fa fa-plus"></i>
                    Novo Feriado
                </a>
            </div>
    <table class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>#</th>
                <th>Data</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Editar</th>
                <th>Apagar</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $feriados as $feriado)
                <tr>
                <td>{{$feriado->id}}</td>
                <td>{{$feriado->data->format('d/m/Y')}}</td>
                <td>{{$feriado->nome}}</td>
                <td>{{$feriado->tipo}}</td>
                <td>
                    <a href="/admin/feriados/{{$feriado->id}}/edit" class="btn btn-success btn-xs">
                        <i class="fa fa-edit"></i>
                        Editar
                    </a>
                </td>
                <td>
                        <a href="/admin/feriados/{{$feriado->id}}/edit" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                            Apagar
                        </a>
                </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection