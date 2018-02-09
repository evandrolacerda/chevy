@extends('layouts.app')

@section('content')

<h3>Ranking Geral</h3>

<div class="panel panel-success">
    <div class="panel-heading">
        Ranking Geral para o mês Atual
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Colaborador</th>
                        <th>Pontos Processo 1</th>
                        <th>Pontos Processo 2</th>
                        <th>Pontos Processo 3</th>
                        <th>Pontos Processo 4</th>
                        <th>Pontos Processo 5</th>
                        <th>Metas</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $ranking as $a)
                    <tr>
                        <td>{{$a->getUsuario()->name}}</td>
                        <td>{{$a->getProcessoOne()}}</td>
                        <td>{{$a->getProcessoTwo()}}</td>
                        <td>{{$a->getProcessoThree()}}</td>
                        <td>{{$a->getProcessoFour()}}</td>
                        <td>{{$a->getProcessoFive()}}</td>
                        <td>{{$a->getMetas()}}</td>
                        <td>{{$a->getTotal()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">
        Ranking Geral para o mês {{$mes_anterior}}
    </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Colaborador</th>
                        <th>Pontos Processo 1</th>
                        <th>Pontos Processo 2</th>
                        <th>Pontos Processo 3</th>
                        <th>Pontos Processo 4</th>
                        <th>Pontos Processo 5</th>
                        <th>Metas</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $anterior as $a)
                    <tr>
                        <td>{{$a->getUsuario()->name}}</td>
                        <td>{{$a->getProcessoOne()}}</td>
                        <td>{{$a->getProcessoTwo()}}</td>
                        <td>{{$a->getProcessoThree()}}</td>
                        <td>{{$a->getProcessoFour()}}</td>
                        <td>{{$a->getProcessoFive()}}</td>
                        <td>{{$a->getMetas()}}</td>
                        <td>{{$a->getTotal()}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
</div>

@endsection
