@extends('admin.layouts.app')

@section('content')
<h1>Prova de {{$prova->mes}}/{{$prova->ano}}</h1>

<h2>Perguntas</h2>
<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>#</th>
            <th>Pergunta</th>
            <th>Editar</th>
        </tr>
    </thead>
    <tbody>
        @foreach( $prova->perguntas as $pergunta )
        <tr>
            <td>{{$pergunta->id}}</td>
            <td>{{$pergunta->pergunta}}</td>
            <td>
                <a href="/admin/pergunta/{{$pergunta->id}}/edit" class="btn btn-xs btn-success">
                    Editar Pergunta
                    <i class="fa fa-edit"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>

</table>
@endsection
