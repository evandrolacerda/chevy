@extends('layouts.app')

@section('content')
<h3>Processo -P3 - Abertura de Hotlist</h3>
<div class="alert alert-info">
    <p>
        Realizar a abertura dos clientes da Hotlist dentro do mês conforme meta de abertura do mês. Cada
        membro da equipe de vendas terá uma meta de abertura mensal que deverá ser cumprida.
    </p>
    <p>
        A pontuação para esse processo será computada através de relatórios emitido pela administração de vendas e distribuidores.
        O lançamento desse relatório no sistema é de responsabilidade do Administrador, 
        você receberá uma notificação quando for pontuado.
    </p>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        Histórico - Abertura de Hotlist
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mês</th>
                        <th>Ano</th>
                        <th>Meta Estabelecida</th>
                        <th>Atingido</th>
                        <th>Lançado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $hotlists as $hotlist)
                    <tr>
                        <td>{{$hotlist->mes}}</td>
                        <td>{{$hotlist->ano}}</td>
                        <td>{{$hotlist->meta}}</td>
                        <td>{{$hotlist->atingido}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($hotlist->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
