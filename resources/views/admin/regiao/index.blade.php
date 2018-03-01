@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="#">Admin</a></li>
    <li><a href="#">Região</a></li>
</ol>



<div class="panel panel-success">
    <div class="panel-heading">Regiões</div>
    <div class="panel-body">

        <span class="pull-right">
            <a class="btn btn-success btn-sm" href="{{url('/admin/regiao/create')}}">
                <i class="fa fa-plus"></i>
                Cadastrar nova Região
            </a>
        </span>
        <br>
        <br>

        <table class="table table-bordered table-condensed table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Região</th>
                    <th>Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $regioes as $regiao)
                <tr>
                    <td>{{$regiao->id}}</td>
                    <td>{{$regiao->nome}}</td>
                    <td>
                        <a href="/admin/regiao/{{$regiao->id}}/edit" class="btn btn-xs btn-success">
                            Editar
                            <i class="fa fa-edit"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection
