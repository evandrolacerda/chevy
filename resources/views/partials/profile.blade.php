<div>
    <div class="panel panel-default">
        <div class="panel-heading">  <h4 >Perfil</h4></div>
        <div class="panel-body">
            <div class="box box-info">

                <div class="box-body">
                    <div class="col-sm-7">
                        <div  align="center"> 
                            <img alt="User Pic" src="https://x1.xingassets.com/assets/frontend_minified/img/users/nobody_m.original.jpg" id="profile-image1" class="img-circle img-responsive">
                            <input id="profile-image-upload" class="hidden" type="file">
                            <div style="color:#999;" >Clique para trocar a imagem</div>
                            <!--Upload Image Js And Css-->
                        </div>

                        <br>

                        <!-- /input-group -->
                    </div>
                    <div class="col-sm-5">
                        <h4 style="color:#00b1b1;">
                            {{Auth::user()->name}}
                        </h4>
                        <span>
                            <p>{{Auth::user()->role->nome}}</p>
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <hr style="margin:5px 0 5px 0;">
                    <div class="col-sm-5 col-xs-6 tital">
                        Faixa Atual
                    </div>
                    <div class="col-sm-7 col-xs-6">
                        {{Auth::user()->faixas->first()->descricao}}
                    </div>
                    <div class="clearfix"></div>
                    <div class="bot-border"></div>

                    <div class="col-sm-5 col-xs-6 tital " >Pontuação:</div>
                    <div class="col-sm-7">
                        <span class="label label-success">
                            100
                        </span>
                    </div>
                    <div class="clearfix"></div>
                    <hr style="margin:5px 0 5px 0;">

                    <div>
                        <a href="/profile" class="btn btn-success btn-sm btn-block">
                            Mudar Senha
                        </a>
                        <br>
                    </div>
                    <div>
                        <a href="/history" class="btn btn-primary btn-sm btn-block">Meu Histórico</a>
                        <br>
                    </div>
                    <div>
                        <a href="/ranking" class="btn btn-primary btn-sm btn-block">Ranking Geral</a>
                    </div>


                    <!-- /.box-body -->
                </div>
                <!-- /.box -->

            </div>


        </div>
    </div>
</div>
@push('scripts')
<script>
    $(function () {
        $('#profile-image1').on('click', function () {
            $('#profile-image-upload').click();
        });
    });
</script>
@endpush
