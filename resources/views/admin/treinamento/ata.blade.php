@extends('admin.layouts.app')

@section('content')
<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Treinamento</a></li>
</ol>

<h1>Envios do Processo P5 - Treinamento</h1>
<div class="panel panel-default">
    <div class="panel-heading">
        Envios do Processo P5 - Treinamento
    </div>
    <div class="panel-body">
        <div>
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li role="presentation" class="active">
                    <a href="#visitas" aria-controls="home" role="tab" data-toggle="tab">
                        <i class="fa fa-file-excel"></i> Atas de Treinamento 
                    </a>
                </li>
                <li role="presentation">
                    <a href="#metas" aria-controls="profile" role="tab" data-toggle="tab">
                        <i class="fa fa-file-excel"></i> Fotos de Treinamento
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
                            @foreach( $atas as $ata )
                            <tr>
                                <td>{{$ata->user->name}}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($ata->created_at))}}</td>
                                <td>{{$ata->mes}}</td>
                                <td>{{$ata->ano}}</td>
                                <td class="text-center">
                                    <a href="/storage/{{substr($ata->arquivo, 6)}}" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-download"></span>
                                        Donwload
                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('/admin/processo/invalidar/5/'. $ata->user_id . '/' .
                                                $ata->mes . '/' . $ata->ano)}}" 

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
                            @foreach( $fotos as $foto )
                            <tr>
                                <td>{{$foto->user->name}}</td>
                                <td>{{date('d/m/Y H:i:s', strtotime($foto->created_at))}}</td>

                                <td class="text-center">
                                    <a href="storage/{{substr($foto->arquivo,6)}}" target="__blank" class="btn btn-success btn-sm">
                                        <span class="glyphicon glyphicon-download"></span>
                                        Download

                                    </a>
                                </td>
                                <td class="text-center">
                                    <a href="{{url('/admin/processo/invalidar/5/'. $foto->user_id . '/' .
                                                $foto->mes . '/' . $foto->ano)}}" 

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
