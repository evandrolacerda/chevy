@extends('admin.layouts.app')

@section('content')
<div class="panel panel-danger">
    <div class="panel-heading">Invalidar Processo</div>
    <div class="panel-body">
        <form name="invalidar" action="/admin/pontuacao/{{$pontuacao->id}}" method="POST" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <div class="form-group">
                <label for="processo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Processo
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="processo" readonly value="{{$pontuacao->processo->nome}}"
                           class="form-control" type="text" name="processo">
                </div>
            </div>
            <div class="form-group">
                <label for="processo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Mês
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="mes" readonly value="{{$pontuacao->mes}}"
                           class="form-control" type="text" name="mes">
                </div>
            </div>
            <div class="form-group">
                <label for="processo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Ano
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="mes" readonly value="{{$pontuacao->ano}}"
                           class="form-control" type="text" name="mes">
                </div>
            </div>
            <div class="form-group">
                <label for="processo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Colaborador
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="processo" readonly value="{{$pontuacao->user->name}}"
                           class="form-control" type="text" name="processo">
                </div>
            </div>
            <div class="form-group">
                <label for="motivo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Motivo
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="motivo" id="motivo" class="form-control">
                        @foreach( $motivos as $motivo)
                        <option value="{{$motivo->id}}">{{$motivo->descricao}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="descricao" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Descrição do Motivo
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="descricao_motivo" class="form-control" rows="10"></textarea>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
