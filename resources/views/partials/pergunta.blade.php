<div class="panel panel-default">
    <div class="panel-heading">
        Pergunta
    </div>
    <div class="panel-body">
        <form method="POST" action="/admin/pergunta" class="form-horizontal">
            {{csrf_field()}}
            <input type="hidden" value="{{$pergunta->id}}"
            <div class="form-group">
                <label for="pergunta" class="control-label col-md-3 col-sm-3 col-xs-12">
                    Resposta
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea name="resposta" id="pergunta" class="form-control" rows="<5></5>"></textarea>
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
