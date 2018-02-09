<div class="panel panel-primary">
    <div class="panel-heading">
        Planilha de desdobramento de Metas
    </div>
    <div class="panel-body">
        <form method="post" action="{{url('/planejamento/metas')}}" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-12">
                    <input id="email" type="file" class="form-control" name="metas" required autofocus>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-4">
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>
        </form>
    </div>
</div>
