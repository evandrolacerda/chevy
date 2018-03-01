@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/faixa">Faixas</a></li>
    <li><a href="/admin/faixa/create">Create</a></li>
</ol>

<div class="panel panel-success">
    <div class="panel-heading">Nova Faixa</div>
    <div class="panel-body">
        <form action="/admin/faixa/create" method="post" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group">
                <label for="descricao" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Descrição
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="descricao" class="form-control col-md-7 col-xs-12" type="text" name="descricao">
                </div>
            </div>
            <div class="form-group">
                <label for="cor" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Cor
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="cor" class="form-control col-md-7 col-xs-12" type="text" name="cor">
                </div>
            </div>
            <div class="form-group">
                <label for="ordem" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Ordem
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="ordem" class="form-control col-md-7 col-xs-12" type="number" name="ordem">
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
