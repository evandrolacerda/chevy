@extends('layouts.app')

@section('content')
<div class="page-header">
    <h1>Envios Para o Processo - P1 - Planejamento</h1>
</div>

@if( $showFormVisitas )
@include('partials.visitas')
@else
<div class="alert alert-dismissable alert-success">
    <p>Você já enviou o arquivo de visitas.</p>
</div>
@endif
@if( $showFormMetas )
@include('partials.metas')
@else
<div class="alert alert-dismissable alert-success">
    <p>Você já enviou o arquivo de Metas.</p>
</div>
@endif
@endsection


