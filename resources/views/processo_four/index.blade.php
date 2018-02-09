@extends('layouts.app')

@section('content')
<h3>Processo -P4 - Presença em Loja</h3>
<div class="alert alert-info">
    <p>
        Disponibilizar os produtos D.I. nas gôndolas dos pontos de vendas. 50% dos pontos desse processo
        serão obtidos se seu índice de presença geral D.I. for igual ou superior a 80% nas visitas realizadas e registradas pelos
        promotores lideres. 25% dos pontos será obtido se o índice de presença de GRANPURE for igual ou superior a 80% e os
        outros 25% dos pontos será obtido se o índice de presença de SENSE for igual ou superior a 80%. Se o vendedor não
        tiver nenhuma loja atendida por equipe de merchandising, a pontuação referente a este processo migrará para o P3:
        Abertura Hotlist.
    </p>
    <p>
        A pontuação para esse processo será computada através de relatórios emitido pela administração de vendas e distribuidores.
        O lançamento desse relatório no sistema é de responsabilidade do Administrador, 
        você receberá uma notificação quando for pontuado.
    </p>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        Histórico - Presença em Loja
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Mês</th>
                        <th>Ano</th>
                        <th>Indice Total</th>
                        <th>Indíce Granpure</th>
                        <th>Indíce Sense</th>
                        <th>Processado em</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $presencas as $presenca)
                    <tr>
                        <td>{{$presenca->mes}}</td>
                        <td>{{$presenca->ano}}</td>
                        <td>{{$presenca->indice_geral}}</td>
                        <td>{{$presenca->indice_granpure}}</td>
                        <td>{{$presenca->indice_sense}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($presenca->created_at))}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
