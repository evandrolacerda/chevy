<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \App\Http\Requests\ImageUploadRequest;
use \Illuminate\Support\Facades\Validator;
    
class ProcessoTwoController extends Controller {

    private $competencia;
    private $numberFilesToSend;
    private $service;
    private $arquivosRepo;

    public function __construct() {
        
        $this->service = new \App\Services\ProcessoTwoService();

        $this->arquivosRepo = new \App\Repositories\ArquivosRepository();
        
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
        
        $this->numberFilesToSend = $this->service
                ->getFilesRemaining(Auth::user()->id, $mes, $ano
        );
        $quantidadesPerRole = $this->service->getQuantityPerRole();


        return view('processo_two.index', ['quantidade' => $this->numberFilesToSend,
            'mes' => $mes,
            'ano' => $ano,
            'quantidadePerRole' => $quantidadesPerRole]);
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
        } catch (PostTooLargeException $poe) {
            return back()->withErrors();
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        try {
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

        $rules = Validator::make($request->all(), [
                    'data' => 'required',
                    'legenda' => 'required'
        ]);

        if (!$rules->passes()) {

            return response()->json(['error' => $rules->errors()->all()]);
        }
        
        try {
            
            $this->service->update($request->all());

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

            $this->service->delete($id);
        } catch (\Exception $exc) {
            throw new \Exception($exc);
        }
    }

    public function getPhotos() {
        return $this->arquivosRepo
                        ->getArquivosBy(
                                $this->competencia->format('m'), 
                                $this->competencia->format('Y'), 
                                \App\Arquivo::FILE_FOTO_VISITA, 
                                Auth::user()->id
        );
    }

}
