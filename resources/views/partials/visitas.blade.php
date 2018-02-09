<div class="panel panel-primary">
    <div class="panel-heading">
        Planilha de Sistemática de Visitas
    </div>

    <div class="panel-body">
        <form class="form-horizontal" enctype="multipart/form-data" method="POST" action="{{ url('/planejamento') }}">
            {{ csrf_field() }}

            <div class="form-group">
                

                <div class="col-md-12">
                    <input id="visitas" type="file" class="form-control" 
                           name="visitas" required autofocus>

                </div>
            </div>
            
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <button type="reset" class="btn btn-danger">Cancelar</button>
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </div>
            
        </form>
    </div>
</div>

