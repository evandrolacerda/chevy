@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
  <li><a href="/admin">Admin</a></li>
  <li><a href="/admin/usuarios">Usuários</a></li>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">Usuários</div>
    <div class="panel-body">
        <div class="pull-right">
            <a href="/admin/register" class="btn btn-sm btn-success">
                <i class="fa fa-plus"></i>
                Adicionar Novo Usuário
            </a>
        </div>
        <br>
        <br>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <td>#</td>
                    <td>Nome</td>
                    <td>CPF</td>
                    <td>email</td>
                    <td>Perfil</td>
                    <td>Editar</td>
                    <td>Inativar</td>
                </tr>
            </thead>
            <tbody>
                @foreach( $users as $user )
                <tr>
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->cpf}}</td>
                    <td>{{$user->email}}</td>
                    <td>
                        <a href="/admin/usuarios/{{$user->id}}" class="btn btn-info btn-xs">
                            <i class="fa fa-user"></i> Cadastro
                        </a>
                    </td>
                    <td>
                        <a href="/admin/usuarios/{{$user->id}}/edit" class="btn btn-success btn-xs">
                            <i class="fa fa-edit"></i> Editar
                        </a>
                    </td>
                    <td>
                        @if( $user->ativo )
                        <a href="/admin/usuarios/inativar/{{$user->id}}" class="btn btn-danger btn-xs">
                            <i class="fa fa-ban"></i> Inativar
                        </a>
                        @else
                        <a href="/admin/usuarios/inativar/{{$user->id}}" class="btn btn-success btn-xs">
                            <i class="fa fa-ban"></i> Ativar
                        </a>
                        @endif
                        
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection
