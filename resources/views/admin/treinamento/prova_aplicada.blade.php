@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/provas-aplicadas">Provas Aplicadas</a></li>
    <li><a href="/admin/provas-aplicadas/{{$prova->provaRespondida->id}}">Prova Aplicada</a></li>
</ol>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="panel panel-success">
            <div class="panel-heading">Prova de {{$prova->user->name}}</div>
            <div class="panel-body">
                <p>Função: <strong>{{$prova->user->role->nome}}</strong></p>
                <p>Prova: <strong>{{$prova->prova->mes}}/{{$prova->prova->ano}}</strong></p>
                <p>Data: <strong>{{date('d/m/Y H:i:s', strtotime($prova->provaRespondida->created_at))}}</strong></p>
            </div>
            <div class="panel-footer">
                <a href="/admin/processo/invalidar/5/{{$prova->user->id}}/{{$prova->prova->mes}}/{{$prova->prova->ano}}" 
                   class="btn btn-danger btn-sm">
                    <i class="fa fa-ban"></i>
                    Invalidar Pontos para esse Processo
                </a>
            </div>
        </div>
        
        <hr>

        <?php $counter = 1; ?>
        @foreach( $prova->prova->perguntas as $pergunta )
        <div class="panel panel-default">
            <div class="panel-heading">Pergunta {{$counter}}</div>
            <div class="panel-body">

                <blockquote>{{$pergunta->pergunta}}</blockquote>

                <p>
                    R:<strong>
                        {{$prova->respostas[$pergunta->id]->resposta}}
                    </strong>
                </p>
            </div>  
        </div>
        <?php $counter++; ?>
        @endforeach

        <div class="col-md-3 pull-right">
            <a href="/admin/processo/invalidar/5/{{$prova->user->id}}/{{$prova->prova->mes}}/{{$prova->prova->ano}}" 
               class="btn btn-danger btn-block btn-sm">
                <i class="fa fa-ban"></i>
                Invalidar
            </a>
        </div>
    </div>
</div>

@endsection

@push('styles')

@endpush