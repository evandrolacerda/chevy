@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/usuarios">Usuários</a></li>
    <li><a href="/admin/usuarios">Usuário</a></li>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">Usuários</div>
    <div class="panel-body">
        <div class="pull-right">
            <a href="/admin/usuarios/{{$user->id}}/edit" class="btn btn-sm btn-success">
                <i class="fa fa-edit"></i>
                Editar Cadastro do Usuário
            </a>
        </div>
        <br>
        <hr>
        <table class="table table-condensed table-striped table-bordered">
            <tr>
                <td>Nome:</td>
                <td>
                    <strong>{{$user->name}}</strong>
                </td>
            </tr>
            <tr>
                <td>CPF:</td>
                <td><strong>{{$user->cpf}}</strong></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><strong>{{$user->email}}</strong></td>
            </tr>
            <tr>
                <td>Função:</td>
                <td><strong>{{$user->role->nome}}</strong></td>
            </tr>
            <tr>
                <td>Chefia:</td>
                <td>
                    @if( $user->chefia != null )
                    <strong>{{$user->chefia->id}} - {{$user->chefia->name}}</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Região Atuante:</td>
                <td>
                    @if( $user->regiao != null )
                    <strong>{{$user->regiao->nome}}</strong>
                    @endif
                </td>
            </tr>
            <tr>
                <td>Endereço: </td>
                <td>
                    <address>
                        {{$user->rua}}, {{$user->numero}}
                        {{$user->bairro}} <br> {{$user->cidade}} - {{$user->estado}}
                    </address>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Telefone: </td>
                <td>
                    {{$user->telefone}}<br>
                    {{$user->celular}}
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Ativo </td>
                <td>
                    @if( $user->ativo )
                    <span class="badge badge-success">Ativo</span>
                    @else
                    <span class="badge badge-danger">Inativo</span>
                    @endif
                    
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>Cadastrado em:</td>
                <td>
                    <strong>{{date('d/m/Y H:i:s', strtotime($user->created_at))}}</strong>
                </td>
            </tr>
            <tr>
                <td>Última Atualização em:</td>
                <td>{{date('d/m/Y H:i:s', strtotime($user->updated_at))}}</td>
            </tr>
        </table>

    </div>
</div>
@endsection

