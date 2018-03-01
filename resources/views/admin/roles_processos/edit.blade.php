@extends('admin.layouts.app')

@section('content')
<div class="panel panel-success">
    <div class="panel-heading">Pontos Por Processo</div>
    <div class="panel-body">
        <form action="/admin/pontos/{{$processo->id}}" method="post" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="processo_id" value="{{$processo->id}}">
            
            
            <div class="form-group">

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <label>
                        Processo
                    </label>
                    <input id="processo" class="form-control" readonly value="{{$processo->nome}}" 
                    type="text" name="processo">
                </div>
            </div>

            @foreach( $processo->roles as $role)
            <div class="form-group">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <label>Função</label>
                    <input id="funcao" class="form-control" readonly="true" 
                           value="{{$role->nome}}" type="text" name="funcao[{{$role->id}}]">
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <label>Pontos</label>
                    <input id="funcao" class="form-control" value="{{$role->pivot->pontos}}" 
                           type="text" name="pontos[{{$role->id}}]">
                </div>
            </div>



            @endforeach
            <br>
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
@foreach( $processo->roles as $roles)

@endforeach

@endsection
