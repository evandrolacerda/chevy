@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Treinamento</a></li>
    <li><a href="#">Prova</a></li>
    <li><a href="#">Create</a></li>
</ol>
<div class="panel panel-success">
    <div class="panel-heading">
        Cadastro de Prova
    </div>
    <div class="panel-body">
        <form action="/admin/prova" method="post" class="form-horizontal">
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
            <fieldset>
                <legend>Questões</legend>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Questão 1
                        </label>
                        <textarea id="questao" class="form-control col-md-7 col-xs-12" name="questao[]"></textarea>
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Questão 2
                        </label>
                        <textarea id="questao" class="form-control col-md-7 col-xs-12" name="questao[]"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Questão 3
                        </label>
                        <textarea id="questao" class="form-control col-md-7 col-xs-12" name="questao[]"></textarea>
                    </div>

                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Questão 4
                        </label>
                        <textarea id="questao" class="form-control col-md-7 col-xs-12" name="questao[]"></textarea>
                    </div>
                </div> 
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>
                            Questão 5
                        </label>
                        <textarea id="questao" class="form-control col-md-7 col-xs-12" name="questao[]"></textarea>
                    </div>
                </div>
            </fieldset>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>

        </form>
    </div>
</div>


@endsection
