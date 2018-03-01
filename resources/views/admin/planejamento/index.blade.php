@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Planejamento</a></li>
</ol>

<h1>Envios do Processo P1 - Planejamento</h1>

<div class="panel">
    <div class="panel-body">

            <form class="navbar-form">
                <div class="form-group">
                    <div class="col-md-6 col-sm-6">
                        <select name="mes" class="form-control">
                        <option value="1">Janeiro</option>
                        <option value="2">Fevereiro</option>
                        <option value="3">Março</option>
                        <option value="4">Abril</option>
                        <option value="5">Maio</option>
                        <option value="6">Junho</option>
                        <option value="7">Julho</option>
                        <option value="8">Agosto</option>
                        <option value="9">Setembro</option>
                        <option value="10">Outubro</option>
                        <option value="11">Novembro</option>
                        <option value="12">Dezembro</option>
                    </select>
                    </div>
                </div>
                <div class="form-group">
                    <select name="ano" class="form-control col-md-6 col-sm-6">
                        <option value="2018">2018</option>
                        <option value="2018">2019</option>
                        <option value="2019">2020</option>
                        <option value="2021">2021</option>
                    </select>  
                </div>
                <button type="submit" class="btn btn-primary">Buscar</button>
            </form>

    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        Envios do Processo P1 - Processamento
    </div>
    <div class="panel-body">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#visitas" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-file-excel"></i> Planilha com sistemática de visitas 
                    </a>
                </li>
                <li role="presentation">
                    <a href="#metas" aria-controls="profile" role="tab" data-toggle="tab">
                        <i class="fa fa-file-excel"></i> Planilha de desdobramento de metas
                    </a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="visitas">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Colaborador</th>
                                <th>Enviado em</th>
                                <th>Mês</th>
                                <th>Ano</th>
                                <th>Download</th>
                                <th>Invalidar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $visitas as $visita )
                            <tr>
                                <td>{{$visita->user->name}}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($visita->created_at))}}</td>
                                <td>{{$visita->mes}}</td>
                                <td>{{$visita->ano}}</td>
                                <td class="text-center">
                                    <a href="{{url('/storage/visitas/' .$visita->arquivo)}}" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-download"></span>
                                        Donwload
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('/admin/processo/invalidar/1/'. $visita->user_id . '/' .
                                                $visita->mes . '/' . $visita->ano)}}" 

                                       class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-ban-circle"></span>
                                        Invalidar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="metas">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Colaborador</th>
                                <th>Enviado em</th>
                                <th>Download</th>
                                <th>Download</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach( $metas as $meta )
                            <tr>
                                <td>{{$meta->user->name}}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($meta->created_at))}}</td>

                                <td class="text-center">
                                    <a href="{{url('/storage/metas/' .$meta->arquivo)}}" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-download"></span>
                                        Download

                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('/admin/processo/invalidar/1/'. $meta->user_id . '/' .
                                                $meta->mes . '/' . $meta->ano)}}" 

                                       class="btn btn-danger btn-sm">
                                        <span class="glyphicon glyphicon-ban-circle"></span>
                                        Invalidar
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>

                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    $(document).ready(function () {

        $(document).ajaxStart(function () {
            $("#loader").css("display", "block");
        });
        $(document).ajaxComplete(function () {
            $("#loader").css("display", "none");
        });

        $('.invalidar').click(function (event) {

            event.preventDefault();

            var id = $(this).data('id');
            var url = "/admin/pergunta/" + id;

            var token = document.head.querySelector('meta[name="csrf-token"]');

            console.log(token.content);

            data = {
                '_method': 'DELETE',
                '_token': token.content,
                'id': id
            };

            $.ajax({
                type: "POST",
                url: url,
                data: data,
                success: function (data) {
                    location.reload();
                }
            });
        });
    });
</script>

@endpush

