@extends('layouts.app')

@section('content')
<h3>Meu Histórico</h3>
<hr>
<div class="panel panel-success">
    <div class="panel-heading">Mês Atual - Processos</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Processo</th>
                        <th>Pontos</th>
                        <th>Mês</th>
                        <th>Pontuado em</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach( $atual as $a)
                    <tr>
                        <td>{{$a->processo->nome}}</td>
                        <td>{{$a->pontos}}</td>
                        <td>{{$a->mes}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($a->created_at))}}</td>
                    </tr>
                    @php $total += $a->pontos @endphp
                    @endforeach
                    <tr>
                        <td><span class="pull-right">Total</span></td>
                        <td class="bg-success"><span class="pull-right">
                                <strong>{{$total}}</strong></span></td>
                        <td><span class="pull-right">&nbsp;</span></td>
                        <td><span class="pull-right">&nbsp;</span></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>

<div class="panel panel-success">
    <div class="panel-heading">Mês Anterior Processos</div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Processo</th>
                        <th>Pontos</th>
                        <th>Mês</th>
                        <th>Pontuado em</th>
                    </tr>
                </thead>
                <tbody>
                    @php $total = 0 @endphp
                    @foreach( $anterior as $a)
                    <tr>
                        <td>{{$a->processo->nome}}</td>
                        <td>{{$a->pontos}}</td>
                        <td>{{$a->mes}}</td>
                        <td>{{date('d/m/Y H:i:s', strtotime($a->created_at))}}</td>
                    </tr>
                    @php $total += $a->pontos @endphp
                    @endforeach
                    <tr>
                        <td><span class="pull-right">Total</span></td>
                        <td class="bg-success"><span class="pull-right">
                                <strong>{{$total}}</strong></span></td>
                        <td><span class="pull-right">&nbsp;</span></td>
                        <td><span class="pull-right">&nbsp;</span></td>
                    </tr>
                </tbody>
            </table>

        </div>
    </div>
</div>


@endsection
