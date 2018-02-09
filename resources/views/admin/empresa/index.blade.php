@extends('admin.layouts.app')

@section('content')
<form action="/admin/empresa" method="POST">
    {{csrf_field()}}
    
    <div class="form-group">
        <label for="nome" class="control-label col-md-3 col-sm-3 col-xs-12">
            Nome da Empresa
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="nome" class="form-control col-md-7 col-xs-12" type="text" name="nome">
        </div>
    </div>
    <div class="form-group">
        <label for="label" class="control-label col-md-3 col-sm-3 col-xs-12">
            labelText
        </label>
        <div class="col-md-6 col-sm-6 col-xs-12">
            <input id="label" class="form-control col-md-7 col-xs-12" type="type" name="label">
        </div>
    </div>
</form>
@endsection
