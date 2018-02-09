@extends('admin.layouts.app')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        Registrar nova Pergunta
    </div>
    <div class="panel-body">
        <form method="POST" action="/admin/pergunta" class="form-horizontal">
            {{csrf_field()}}

            <div class="form-group">
                <label for="pergunta" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Pergunta
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="pergunta" id="pergunta" class="form-control" rows="<5></5>"></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="processo" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Processo
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <select name="processo" id="processo" class="form-control">
                        @foreach( $processos as $processo)
                        <option value="{{$processo->id}}">{{$processo->nome}}</option>
                        @endforeach
                    </select>
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