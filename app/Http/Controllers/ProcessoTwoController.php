<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\Util\Calendar;
use \App\Http\Requests\ImageUploadRequest;
use \App\Repositories\EnviosProcessoTwoRepository;
use Illuminate\Http\Exceptions\PostTooLargeException ;
class ProcessoTwoController extends Controller {

    private $enviosRepo;
    private $competencia;
    private $numberFilesToSend;

    private $service;
    
    public function __construct() {

        $this->enviosRepo = new EnviosProcessoTwoRepository();
        $this->service = new \App\Services\ProcessoTwoService();
        
        $this->competencia = $this->service->getCompetencia();
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ano = $this->competencia->format('Y');
        $mes = $this->competencia->format('m');
        $this->numberFilesToSend = $this->enviosRepo
                ->getFilesRemaining(Auth::user()->id, 
                        $mes, 
                        $ano
                        );
        $quantidadesPerRole = $this->enviosRepo->getQuantityPerRole();


        return view('processo_two.index', ['quantidade' => $this->numberFilesToSend, 
            'mes' =>$mes, 
            'ano' => $ano,
            'quantidadePerRole' => $quantidadesPerRole]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ImageUploadRequest $request) {
        
            try {
                $files = $request->file('fotos');

                $request->handle($files);

                return back()->with('status', 'Fotos enviadas com sucesso');
            } catch (\Exception $ex) {
                return back()->withErrors([$ex->getMessage()]);
            } catch (PostTooLargeException $poe ){
                return back()->withErrors();
            }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try{
            $this->service->delete($id);
            
            return back()->with('status', 'Foto deletada');
        } catch (\Exception $ex) {
            return back()->withErrors([$ex->getMessage()]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        
        $rules = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'data' => 'required',
            'local' => 'required'
        ]);
        
        if( !$rules->passes() ){
            
            
            return response()->json(['error'=>$rules->errors()->all()]);
        }
        try{
            $this->service->update( $request->all() );
            
            return response()->json(['success' => 'Informações atualizadas']);
            
        } catch (\Exception $ex) {
            return response()->json([$ex->getMessage()]);
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        try {
            
            $this->service->delete( $id );
            
        } catch (\Exception $exc) {
            throw new \Exception( $exc );
        }

        
    }

    public function getPhotos() {
        return $this->enviosRepo->getAlreadySent(Auth::user()->id, $this->competencia->format('m'), $this->competencia->format('Y'));
    }

}
