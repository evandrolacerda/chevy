@extends('admin.layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">Registrar novo usuário</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                    {{ csrf_field() }}

                    <div class="form-group">

                        <div class="col-md-6">
                            <label>Nome</label>
                            <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>
                        </div>
                        <div class="col-md-6">
                            <label>E-Mail</label>
                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-6">
                            <label>Senha</label>
                            <input id="password" type="password" class="form-control" name="password" required>

                        </div>

                        <div class="col-md-6">
                            <label>Confirmar Senha</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>
                    </div>

                    <div class="form-group">

                        <div class="col-md-6">
                            <label>Chefia Imediata</label>
                            <select id="chefia" class="form-control" name="chefia" required>
                                @foreach( $chefias as $chefia )
                                <option value="{{$chefia->id}}">{{$chefia->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>CPF</label>
                            <input type="text" name="cpf" id="cpf" value="" class="form-control">
                        </div>

                    </div>
                    <div class="form-group">

                        <div class="col-md-12">
                            <label>Faixa Inicial</label>
                            <select id="faixa" class="form-control" name="faixa" required>
                                @foreach( $faixas as $faixa )
                                <option value="{{$faixa->id}}">{{$faixa->descricao}}</option>
                                @endforeach
                            </select>
                        </div>
                        
                    </div>
                    <div class="form-group">

                        <div class="col-md-6">
                            <label>Função</label>
                            <select id="funcao" class="form-control" name="funcao" required>
                                @foreach( $funcoes as $funcao )
                                <option value="{{$funcao->id}}">{{$funcao->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label>Região</label>
                            <select id="regiao" class="form-control" name="regiao" required>
                                @foreach( $regioes as $regiao )
                                <option value="{{$regiao->id}}">{{$regiao->nome}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <fieldset>
                        <legend>Endereço</legend>
                        <div class="form-group">
                            <div class="col-md-6">
                            <label>
                                CEP
                            </label>
                                <input id="cep" class="form-control" type="text" name="cep">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-8">
                                <label>Rua</label>
                                <input type="text" name="rua" id="rua" value="" class="form-control">
                            </div>
                            <div class="col-md-4">
                                <label>Número</label>
                                <input type="text" name="numero" id="rua" value="" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-4">
                                <label>Bairro</label>
                                <input type="text" name="bairro" id="bairro" value="" class="form-control">
                            </div>
                            <div class="col-md-8">
                                <label>Cidade</label>
                                <input type="text" name="cidade" id="cidade" value="" class="form-control">
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label>Estado</label>

                                <select id="estado" class="form-control col-md-7 col-xs-12" name="estado">
                                    <option value="">Escolha o Estado</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espirito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>  
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>

                            </div>
                            <div class="col-md-8">

                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <div class="col-md-6">
                                <label>
                                    Telefone
                                </label>
                                <input id="telefone" class="form-control" type="text" name="telefone">
                            </div>
                            <div class="col-md-6">
                                <label>
                                    Celular
                                </label>
                                <input id="celular" class="form-control" type="text" name="celular">
                            </div>
                        </div>
                    </fieldset>


                    <div class="form-group">
                        <div class="col-md-6 ">
                            <button type="submit" class="btn btn-primary btn-block">
                                Registrar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
