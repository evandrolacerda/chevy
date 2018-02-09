@extends('admin.layouts.app')

@section('content')

<ol class="breadcrumb">
    <li><a href="/admin">Admin</a></li>
    <li><a href="#">Album</a></li>
</ol>

<div class="gallery-container">

    <div class="panel panel-success">
        <div class="panel-heading">Album de {{$album->user->name}}</div>
        <div class="panel-body">
            <p>Funcão: {{$album->user->role->nome}}</p>
            <p>Mês: {{$album->getMes()}}</p>
            <p>Ano: {{$album->getAno()}}</p>
        </div>
        <div class="panel-footer">
            <a href="{{url('/admin/processo/invalidar/2/'. $album->user->id . '/' .
                                                $album->getMes() . '/' . $album->getAno())}}" 
               class="btn btn-danger btn-sm">
                <span class="glyphicon glyphicon-ban-circle"></span>
                Invalidar Ponto para esse Processo
            </a>
        </div>
    </div>

    <p class="page-description text-center">Fotos enviadas</p>
    <hr>
    <div class="tz-gallery">

        <?php $counter = 1; ?>
        @foreach( $album->getFotos() as $foto)

        @if(  $counter % 4 == 0 )
        <div class="row">

            @endif

            <div class="col-sm-3 col-md-3">
                <div class="thumbnail">
                    <a class="lightbox" href="/{{$foto->arquivo}}">
                        <img src="/{{$foto->thumbs_path}}" alt="Park">
                    </a>
                    <div class="caption">
                        <h4>{{$foto->legenda}}</h4>
                        <p>{{date('d/m/Y', strtotime($foto->data))}}</p>
                    </div>
                </div>
            </div>

            @if(  $counter % 4 == 0 )
        </div>

        @endif
        <?php $counter++; ?>
        @endforeach
    </div>
    </div>
</div>
</div>


@endsection

@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
<link rel="stylesheet" href="/css/gallery-clean.css">
@endpush

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
<script>
baguetteBox.run('.tz-gallery');
</script>


@endpush