@extends('admin.layouts.app')


@section('content')

<ol class="breadcrumb">
  <li><a href="/admin">Admin</a></li>
  <li><a href="/admin/presenca">Presença</a></li>
</ol>

<div class="alert alert-info">
    <p>Envie a planilha para processamento de Presença em loja. A planilha deve conter apenas 
        quatro campos sendo eles, CPF, Total, Granpure e o Sense, na mesma ordem descrito.</p>
</div>
<div class="col-sm-offset-1 col-sm-9">
    <div class="panel panel-default">
        <div class="panel-heading">
            Processamento de Presença em Loja
        </div>


        <div class="panel-body">
            <form action="/admin/presenca" class="form-horizontal" 
                  method="post"
                  enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <label>
                            Planilha
                        </label>
                        <input id="planilha" class="form-control" type="file" name="planilha">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Mês
                        </label>
                        <input id="mes" class="form-control" type="number" value="{{date('m') - 1}}" name="mes">
                    </div>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <label>
                            Ano
                        </label>
                        <input id="planilha" class="form-control" type="number" value="{{date('Y')}}" name="ano">
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <button type="reset" class="btn btn-danger btn-block">Cancelar</button>

                    </div>
                    <div class="col-md-8 col-sm-8 col-xs-12">
                        <button type="submit" class="btn btn-success btn-block">Enviar</button>
                    </div>
                </div>

            </form>
        </div>
    </div>
</div>

@endsection
