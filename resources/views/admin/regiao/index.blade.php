@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
  <li><a href="#">Admin</a></li>
  <li><a href="#">Região</a></li>
</ol>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>#</th>
            <th>Região</th>
            <th>Editar</th>
            <th>Apagar</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $regioes as $regiao)
        <tr>
            <td>{{$regiao->id}}</td>
            <td>{{$regiao->nome}}</td>
            <td>
                <a href="/admin/regiao/{{$regiao->id}}" class="btn btn-sm btn-success">Editar</a>
            </td>
            <td>
                <a href="/admin/regiao/{{$regiao->id}}" class="btn btn-sm btn-success">Deletar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
