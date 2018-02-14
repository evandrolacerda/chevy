<div class="panel panel-primary">
    <div class="panel-heading">
        Ata de Treinamento
    </div>
    <div class="panel-body">
        <form method="post" action="{{url('/ata')}}" enctype="multipart/form-data" class="form-horizontal">
            <div class="form-group">
                {{csrf_field()}}
                <div class="col-md-12">
                    <input id="ata" type="file" class="form-control" name="ata" required autofocus>

                </div>
            </div>
            <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Enviar</button>
                </div>
            </div>
        </form>
    </div>
</div>
