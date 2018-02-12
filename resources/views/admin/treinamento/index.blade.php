@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Treinamento</a></li>
</ol>
<div class="panel">
    <div class="panel-body">

    </div>
</div><form action="/admin/prova" method="post">
    {{csrf_field()}}

    <div class="form-group">
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label>
                Mês
            </label>
            <input id="mes" class="form-control col-md-7 col-xs-12" value="{{date('m')}}" type="number" name="mes">
        </div>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <label>
                Ano
            </label>
            <input id="ano" class="form-control col-md-7 col-xs-12" value="{{date('Y')}}" type="number" name="ano">
        </div>
    </div>
    <div class="form-group">
        <div class="form-group">
            <label for="questao" class="control-label col-md-3 col-sm-3 col-xs-12">
                Questão 1
            </label>
            <div class="col-md-6 col-sm-6 col-xs-12">
                <textarea id="questao" class="form-control col-md-7 col-xs-12" name="questao[]"></textarea>
            </div>
        </div>

    </div>  
</form>

@endsection
