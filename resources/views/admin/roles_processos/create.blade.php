@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin/pontos">Pontos por processo</a></li>
    <li><a href="/admin/pontos/create">Create</a></li>
</ol>


<div class="panel panel-default">
    <div class="panel-heading">Pontos Por Processo</div>
    <div class="panel-body">
        <form action="/admin/pontos" method="post" class="form-horizontal">
            {{csrf_field()}}
            <div class="form-group">
                <label for="processo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Processo
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="processo" id="processo" class="form-control">
                        <option value="">Selecione</option>
                        @foreach( $processos as $processo )
                        <option value="{{$processo->id}}">{{$processo->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="funcao" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Função
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="funcao" id="funcao" class="form-control">
                        <option value="">Selecione</option>
                        @foreach( $funcoes as $funcao )
                        <option value="{{$funcao->id}}">{{$funcao->nome}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="pontos" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Pontos
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input id="pontos" class="form-control col-md-7 col-xs-12" type="number" name="pontos">
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

