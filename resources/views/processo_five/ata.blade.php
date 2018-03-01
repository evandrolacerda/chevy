@extends('layouts.app')

@section('content')
<div class="panel panel-success">
    <div class="panel-heading">
        Processo P5 - Treinamento
    </div>
    <div class="panel-body">

        @if( $showFormAta )
            @include('partials.ata')
        @else
        <h1>Ata de Treinamento</h1>
        <table class="table table-bordered table-bordered">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Data do Envio</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $ata as $a)
                <tr>
                    <td>
                        Ata de Treinamento de {{$a->mes}}/{{$a->ano}}
                    </td>
                    <td>

                        <a href="/storage/{{substr($a->arquivo, 6)}}" class="btn btn-sm btn-success btn-block">
                            Ata de Treinamento
                            <i class="fa fa-file-pdf"></i>
                        </a>
                    </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($a->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif

        @if( $showFormFoto )
        @include('partials.foto')
        @else
        <hr>
        <h1>Foto de Treinamento</h1>
        <table class="table table-bordered table-bordered">
            <thead>
                <tr>
                    <th>Arquivo</th>
                    <th>Data do Envio</th>
                    <th>Download</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $foto as $f)
                <tr>
                    <td>
                        Foto do treinamento {{$f->mes}}/{{$f->ano}}
                    </td>
                    <td>

                        <a href="/storage/{{substr($f->arquivo, 6)}}" class="btn btn-sm btn-success btn-block">
                            Foto do Treinamento
                            <i class="fa fa-file-image"></i>
                        </a>
                    </td>
                    <td>{{date('d/m/Y H:i:s', strtotime($f->created_at))}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>
@endsection
