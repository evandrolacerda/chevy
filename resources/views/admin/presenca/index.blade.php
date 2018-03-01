@extends('admin.layouts.app')


@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/presenca">Presença</a></li>
</ol>


<h1>Presença em Loja</h1>
<hr>
<div class="panel">
    <div class="panel-body">

        <form class="navbar-form">
            <div class="form-group">
                <div class="col-md-6 col-sm-6">
                    <select name="mes" class="form-control">
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <select name="ano" class="form-control col-md-6 col-sm-6">
                    <option value="2018">2018</option>
                    <option value="2018">2019</option>
                    <option value="2019">2020</option>
                    <option value="2021">2021</option>
                </select>  
            </div>
            <button type="submit" class="btn btn-primary">Buscar</button>
        </form>

    </div>
</div>

<div class="table-responsive">
    <div class="panel-body">
        <a href="/admin/presenca/create" class="btn btn-success pull-right">
            <i class="fa fa-cloud-upload-alt"></i>
            Enviar arquivo para Processamento
        </a>
    </div>
    <br>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>Colaborador</th>
                <th>Mês</th>
                <th>Ano</th>
                <th>Indice Geral</th>
                <th>Indice Granpure</th>
                <th>Indice Sense</th>
                <th>Invalidar</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $presencas as $presenca)
            <tr>
                <td>{{$presenca->user->name}}</td>
                <td>{{$presenca->mes}}</td>
                <td>{{$presenca->ano}}</td>
                <td>{{$presenca->indice_geral}}</td>
                <td>{{$presenca->indice_granpure}}</td>
                <td>{{$presenca->indice_sense}}</td>
                <td>
                    <a href="/admin/processo/invalidar/4/{{$presenca->user->id}}/{{$presenca->mes}}/{{$presenca->ano}}"
                       class="btn btn-danger btn-sm">
                        <i class="fa fa-ban"></i>
                        Invalidar Pontos
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{$presencas->appends($_GET)->links()}}
</div>



@endsection
