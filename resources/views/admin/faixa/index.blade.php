@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
  <li><a href="/admin">Admin</a></li>
  <li><a href="/admin/faixas">Faixas</a></li>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">Faixas</div>
    <div class="panel-body">
        <div class="pull-right">
            <a href="/admin/faixa/create" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i>
                Nova Faixa
            </a>
        </div>
        <br>
        <br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Faixa</td>
                    <td>Cor</td>                    
                    <td>Editar</td>                    
                </tr>
            </thead>
            <tbody>
                @foreach( $faixas as $faixa )
                <tr>
                    <td>{{$faixa->id}}</td>
                    <td>{{$faixa->descricao}}</td>
                    <td>{{$faixa->cor}}</td>
                    <td>
                        <a href="/admin/faixa/{{$faixa->id}}/edit" class="btn btn-success btn-xs">
                            <i class="fa fa-edit"></i>
                            Editar
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
