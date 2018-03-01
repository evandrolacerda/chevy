@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="/admin">Região</a></li>
    <li><a href="#">Edit</a></li>
</ol>


<div class="panel panel-success">
    <div class="panel-heading">Cadastro de Região</div>
    <div class="panel-body">
            <form action="/admin/regiao/{{$regiao->id}}" method="POST" class="form-horizontal">
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                    <label for="nome" class="control-label col-md-3 col-sm-3 col-xs-12">
                        Nome da Região
                    </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input id="nome" class="form-control" value="{{$regiao->nome}}" type="text" name="nome">
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

