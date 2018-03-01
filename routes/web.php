<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within a group which
  | contains the "web" middleware group. Now create something great!
  |
 */


Auth::routes();

Route::get('/info', function() {
    phpinfo();
});
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/not', function(){
   $pontuacao = \App\Pontuacao::find(48);
   
   $user = \App\User::find( 10 );
   
   $user->notify( new \App\Notifications\ScoreUpdated($pontuacao));
});

Route::middleware(['auth', 'check.admin'])->group(function () {
    Route::resource('/', 'IndexController');
    Route::resource('/teste', 'TesteController');
    Route::resource('/planejamento', 'ProcessoOneController');
    Route::resource('/planejamento/metas', 'P1MetasEnvioController');
    Route::resource('/visitas', 'ProcessoTwoController');
    Route::resource('/visitas/detalhes', 'VisitasDetalhesController');
    Route::resource('/hotlist', 'ProcessoThreeController');
    Route::resource('/presenca', 'ProcessoFourController');
    Route::resource('/treinamento', 'ProcessoFiveController');
    Route::resource('/history', 'HistoryController');
    Route::resource('/ranking', 'RankingController');
    Route::resource('/processos', 'ProcessosController');
    Route::resource('/notifications', 'NotificationController');
    
    
    Route::get('/album', 'ProcessoTwoController@getPhotos');
    Route::post('/ata', 'ProcessoFiveController@ata');
    Route::post('/foto', 'ProcessoFiveController@foto');
});


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('processo/invalidar/{processo}/{user}/{mes}/{ano}', 'Admin\PontuacaoController@invalidar');
    Route::get('album/{user}/{mes}/{ano}', 'Admin\AlbumController@album');
    Route::get('usuarios/inativar/{id}', 'Admin\UsersController@toogleAtivo');
    
    Route::resource('/pontos', 'Admin\PontosController');
    Route::resource('/treinamento', 'Admin\TreinamentoController');
    Route::resource('/', 'Admin\IndexController');
    Route::resource('/pergunta', 'Admin\PerguntaController');
    Route::resource('/presenca', 'Admin\PresencaController');
    Route::resource('enterprise', 'EnterpriseController');
    Route::resource('regiao', 'Admin\RegiaoController');
    Route::resource('hotlist', 'Admin\HotlistController');
    Route::resource('planejamento', 'Admin\PlanejamentoController');
    Route::resource('visitas', 'Admin\VisitasController');
    Route::resource('pontuacao', 'Admin\PontuacaoController');
    Route::resource('/prova', 'Admin\ProvaController');
    Route::resource('/usuarios', 'Admin\UsersController');
    Route::resource('/pontos', 'Admin\PontosController');
    Route::resource('/faixa', 'Admin\FaixasController');
    Route::resource('/provas-aplicadas', 'Admin\ProvasAplicadasController');
    Route::resource('/processo', 'Admin\ProcessosController');
    Route::resource('/feriados', 'Admin\Feriados');
    
});

