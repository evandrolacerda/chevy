@extends('layouts.app')

@section('content')
<h4>Envios Para o Processo - P2 - Visitas</h4>
<hr>

<div id="loader">

</div>

<div class="alert alert-info">
    <p>
        Você pode enviar {{$quantidadePerRole}} fotos para esse processo. Não se esqueça que após enviar 
        as fotos você deve preencher os campos referentes ao local visitado e a data da visita. Os pontos para 
        esse processo só serão computados se enviar todas as fotos necessárias e preencher os campos de local  e data da visita.
    </p>
</div>

<p class="alert alert-warning">Competência {{$mes}} / {{$ano}}</p>

@if( $quantidade > 0 )
<div class="panel panel-primary">
    <div class="panel-heading">
        Upload de Fotos
    </div>
    <div class="panel-body">
        <form action="{{url('/visitas')}}" 
              id="upload" enctype="multipart/form-data" method="post" class="form-horizontal">
            {{csrf_field()}}

            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <input id="foto" class="form-control" 
                           type="file" name="fotos[]" multiple>
                </div>
            </div>
            <div class="form-group">
                <div class="col-md-12 col-sm-12 col-xs-12 ">
                    <button type="submit" class="btn btn-block btn-success">Enviar</button>
                </div>
            </div>
        </form>


    </div>

</div>

@endif


<div class="modal fade" id="modal-alert" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="exampleModalLabel">Nova Mensagem</h4>
            </div>
            <div class="modal-body">
                <div class="alert" id="js-alert" role="alert">
                    <ul id="errors_msg"></ul>
                    <p id="message"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>

<gallery></gallery>

@endsection
@push('scripts')

<script>
    $(document).ready(function (e) {
        $(document).ajaxStart(function () {
            $("#loader").css("display", "block");
        });
        $(document).ajaxComplete(function () {
            $("#loader").css("display", "none");
        });
    });

    $(document).on('submit', '.detalhes', function (e) {
        e.preventDefault();


        var id = e.target.id;

        console.log(id);
        var form = $("#" + id);

        var data = {
            local: form.find('#local').val(),
            data: form.find('#data').val(),
            _token: document.head.querySelector('meta[name="csrf-token"]').content,
            id: id,
            _method: form.find('#method').val()
        };
        console.log(data);

        $.ajax({
            type: 'POST',
            url: '/visitas/' + id,
            data: data,
            dataType: 'json',
            success: function (data) {
                bus.$emit('reload');
                $("#js-alert").find("ul").html('');
                $('#message').text('');

                if ($.isEmptyObject(data.error)) {
                    var modal = $("#modal-alert");
                    var div = modal.find('#js-alert').removeClass('alert-danger').addClass('alert-success');
                    $('#message').text('Informaçãos Atualizadas com sucesso!');
                    $('#modal-alert').modal({keyboard: true});
                } else {
                    printErrorMsg(data.error);
                }


            },
            error: function (request, status, error) {
                console.table(error);
            }
        });
    });

    function printErrorMsg(msg) {
        $("#js-alert").find("ul").html('');
        $('#message').text('');

        var modal = $("#modal-alert");
        var div = modal.find('#js-alert').addClass('alert-danger');

        $.each(msg, function (key, value) {
            console.log(value);
            console.log(key);
            $("#js-alert").find("#errors_msg").append('<li>' + value + '</li>');
        });

        $('#modal-alert').modal({keyboard: true});
    }

    $(document).on('click', '.deletar', function (e) {
        e.preventDefault();

        var id = e.target.getAttribute('data-id');

        var data = {
            id: id,
            _method: 'DELETE',
            _token: document.head.querySelector('meta[name="csrf-token"]').content
        };


        $.ajax({
            type: 'POST',
            url: '/visitas/' + id,
            data: data,

            success: function (data) {
                bus.$emit('reload');
                $("#js-alert").find("ul").html('');

                if ($.isEmptyObject(data.error)) {
                    var modal = $("#modal-alert");
                    var div = modal.find('#js-alert').removeClass('alert-danger').addClass('alert-success');
                    $('#message').text('Arquivo deletado com sucesso!');
                    $('#modal-alert').modal({keyboard: true});

                    $('#modal-alert').on('hidden.bs.modal', function (e) {
                        location.reload();
                    });
                } else {
                    printErrorMsg(data.error);
                }

            }
        });

    });

</script>

@endpush


