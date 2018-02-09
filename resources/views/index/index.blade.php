@extends('layouts.app')

@section('content')

<ul class="list-group">
    @foreach( $processos as $processo )
    <li class="list-group-item">
        {{$processo->nome}}

    </li>
    @endforeach
</ul>
@endsection

