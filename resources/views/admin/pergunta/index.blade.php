@extends('admin.layouts.app')

@section('content')

<div class="modal fade modal_inativar" tabindex="-1" role="dialog" id="my_modal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Deseja realmente apagar essa pergunta?</h4>
            </div>
            <div class="modal-body">
                <form id="deletar" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="_method" value="delete">
                    <p>
                        Você não poderá desfazer essa operação. Deseja realmente continuar?
                    </p>
                    <input type="hidden" name="arquivo_id" value="" id="arquivo_id">
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>

                <a class=".ina btn btn-danger" id="ina" href="#">
                    Apagar Permanentemente o arquivo
                </a> 
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id="loader">

</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Perguntas
    </div>
    <div class="panel-body">

        <div class="pull-right">
            <a href="/admin/pergunta/create" class="btn btn-success btn-sm">
                Criar nova Pergunta
                <span class="glyphicon glyphicon-plus-sign"></span>
            </a>
        </div>
        <br>
        <br>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Pergunta</th>
                    <th>Processo</th>
                    <th>Editar</th>
                    <th>Apagar</th>
                </tr>
            </thead>
            <tbody>
                @foreach( $perguntas as $pergunta )
                <tr>
                    <td>{{$pergunta->id}}</td>
                    <td>{{$pergunta->pergunta}}</td>
                    <td>{{$pergunta->processo->nome}}</td>
                    <td class="text-center">
                        <a href="{{url(sprintf("/admin/pergunta/%s/edit",$pergunta->id))}}" 
                           class="btn btn-sm btn-success">
                            Editar <i class="fa fa-edit"></i>
                        </a>
                    </td>
                    <td class="text-center">
                        <a href="{{url(sprintf("/admin/pergunta/%s/edit",$pergunta->id))}}"
                           class="btn btn-sm btn-danger deletar" data-id="{{$pergunta->id}}">
                            Apagar <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
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

        $('.deletar').click(function (event) {

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
