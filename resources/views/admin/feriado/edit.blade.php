@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
        <li><a href="/admin">Admin</a></li>
        <li><a href="/admin/feriados/">Feriado</a></li>
        <li><a href="#">Edit</a></li>
    </ol>

<div class="col-md-9 col-sm-9 col-md-offset-1">
        <div class="panel panel-success">
                <div class="panel-heading">Cadastro de Feriado</div>
                <div class="panel-body">
                <form class="form-horizontal" method="post" action="/admin/feriados/{{$feriado->id}}">
                        {{csrf_field()}}
                        <input type="hidden" name="_method" value="PUT">
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                    <label>Data</label>
                            <input type="date" value="{{$feriado->data->format('Y-m-d')}}" name="data" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                    <label>Nome</label>
                            <input type="text" value="{{$feriado->nome}}" name="nome" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-12 col-sm-12">
                                    <label>Tipo</label>
                                    <select name="tipo" class="form-control">
                                        @foreach( $tipos as $key => $value )
                                            <option value="{{$key}}" 
                                            @if($feriado->codigo_tipo == $key) selected @endif>{{$value}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <button type="reset" class="btn btn-danger">Cancelar</button>
                                    <button type="submit" class="btn btn-success">Registrar</button>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
            
</div>

@endsection