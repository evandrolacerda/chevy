@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/usuarios">Pontos por processo</a></li>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">Pontos Por Processo</div>
    <div class="panel-body">
        <div class="pull-right">
            <a href="/admin/pontos/create" class="btn btn-sm btn-success">
                <i class="fa fa-edit"></i>
                Novo Ponto Por Processo
            </a>
        </div>
        <br>
        <hr>
        <table class="table table-condensed table-striped table-bordered">
            <thead>
                <tr>
                    <td>Processo</td>
                    <td>Função</td>
                    <td>Pontos</td>
                    <td>Editar</td>
                </tr>
            </thead>
            <tbody>
                @foreach( $pontos as $ponto )
                @foreach($ponto->roles as $pt)

                <tr>
                    <td>
                        {{$ponto->nome}}
                    </td>
                    <td>
                        {{$pt->nome}}
                    </td>
                    <td>
                        {{$pt->pivot->pontos}}
                    </td>
                    <td>
                        <a href="/admin/pontos/{{$ponto->id}}/edit" class="btn btn-success btn-xs">
                            <i class="fa fa-edit"></i>
                            Editar</a>
                    </td>
                </tr>

                @endforeach
                @endforeach
            </tbody>
        </table>

    </div>
</div>
@endsection

