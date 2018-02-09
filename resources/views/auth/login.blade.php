<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Fazer Login - Sistema de Excelência em Vendas Faixa Preta</title>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
        <!-- Bootstrap -->
        
        

        <style>
            body{
                background-image: url("{{url('/images/faixa_preta.jpg')}}")!important; 
                background-repeat: no-repeat;
                background-size: cover;
                background-color: #192f61;

            }
            
            #login-overlay{
                opacity: 0.9;
                
            }
        </style>

    </head>

    <body class="login">
        <br>
        <br>
        <br>
        <br>
        <div id="login-overlay" class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">      
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">Logar - Programa Faixa Preta</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="well">
                                <form id="loginForm" method="POST" action="{{url('/login')}}" novalidate="novalidate">
                                    {{ csrf_field() }}
                                    <div class="form-group">
                                        <label for="username" class="control-label">E-mail</label>
                                        <input type="text" class="form-control" id="username" name="email" 
                                               value="" required="" title="Digite seu email" placeholder="Email">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="control-label">Senha</label>
                                        <input type="password" class="form-control" id="password" name="password" 
                                               value="" required="" title="Digite sua senha">
                                        <span class="help-block"></span>
                                    </div>
                                    <div id="loginErrorMsg" class="alert alert-error hide"></div>

                                    <button type="submit" class="btn btn-success btn-block">Login</button>
                                    <a href="{{  url('/password/reset') }}" class="btn btn-default btn-block">Esqueci minha senha</a>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>