@extends('layouts.app')

@section('content')

@if( $prova->isComplete() )
<p class="alert alert-info">
    Prova completada, atual completada
</p>
@endif
<div class="panel panel-default">
    <div class="panel-body">
        <h1>Prova de {{$prova->prova->mes}}/{{$prova->prova->ano}}</h1>
        <hr>
        <form class="form-horizontal" method="post">
            {{csrf_field()}}
            
            <input type="hidden" name="mes" value="{{$prova->prova->mes}}">
            <input type="hidden" name="ano" value="{{$prova->prova->ano}}">
            <input type="hidden" name="prova_id" value="{{$prova->prova->id}}">
            
            <?php $counter = 1;?>
            @foreach( $prova->prova->perguntas as $pergunta )
            <div class="panel panel-default">
                <div class="panel-heading">Pergunta {{$counter}}</div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <blockquote>{{$pergunta->pergunta}}</blockquote>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>Sua resposta:</label>
                            <textarea 
                                @if(isset($prova->respostas[$pergunta->id]) ) disabled @endif
                                name="questao[{{$pergunta->id}}]" class="form-control">@if(isset($prova->respostas[$pergunta->id]) ){{$prova->respostas[$pergunta->id]->resposta}}@endif</textarea>
                        </div>
                    </div>  
                </div>
            </div>
            <?php $counter++;?>
            @endforeach
            
            @if( !$prova->isComplete() )
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <button type="reset" disabled="true" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>
            @endif
        </form>
    </div>
</div>

@endsection

@push('styles')

@endpush