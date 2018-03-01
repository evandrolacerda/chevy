<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RoleInterface;
use Illuminate\Support\Facades\Auth;
USE App\Arquivo;

class ProcessoFiveController extends Controller {

    private $provasRepo;
    private $provaService;
    private $ataService;

    public function __construct() {
        $this->provasRepo = new \App\Repositories\ProvaRepository();
        $this->provaService = new \App\Services\ProvaService();
        $this->ataService = new \App\Services\AtaService();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $competencia = $this->ataService->getCompetencia();

        if (in_array(Auth::user()->role->id, [
                    RoleInterface::DIRETOR_VENDAS,
                    //RoleInterface::GERENTE_VENDAS
                ])) {


            $showFormAta = $this->ataService->showFormAta(
                    $competencia->format('m'), $competencia->format('Y'), Auth::user()->id);

            $showFormFoto = $this->ataService->showFormFoto(
                    $competencia->format('m'), $competencia->format('Y'), Auth::user()->id);

            $foto = $this->ataService->fetchFoto(
                    $competencia->format('m'), $competencia->format('Y'), Auth::user()->id
            );
            
            $ata = $this->ataService->fetchAta(
                    $competencia->format('m'), $competencia->format('Y'), Auth::user()->id
            );


            //dd( $showFormAta, $showFormFoto );

            return view('processo_five.ata', compact('showFormFoto', 'showFormAta', 'foto', 'ata'));
        }

        $prova = $this->provasRepo->getAvailable(
                $this->ataService->getCompetencia()
                ->format('m'), $this->ataService->getCompetencia()
                ->format('Y'));

        $applicacaoProva = new \App\Services\Util\AplicacaoProva($prova, Auth::user());

        return view('processo_five.prova', ['prova' => $applicacaoProva]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {

        $this->validate($request, [
            'questao.*' => 'required'
        ]);

        $this->provaService->save($request->all());

        return back()->with('status', 'Prova salva');
    }


    public function ata(Request $request) {
        $this->validate($request, [
            'ata' => 'required|file'
        ]);

        $validExtensions = ['jpg', 'pdf', 'png'];

        if (!in_array($request->file('ata')->getClientOriginalExtension(), $validExtensions)) {
            return back()->withErrors(['Formato de Arquivo inválido! Arquivos Permitidos ' .
                        implode(",", $validExtensions)]);
        }


        $nomeArquivo = sprintf("%s.%s", md5(microtime() .
                        Arquivo::FILE_ATA_TREINAMENT0), $request->file('ata')->getClientOriginalExtension()
        );


        $request->file('ata')->storeAs('public/treinamento/ata/', $nomeArquivo);


        $data = [
            'mes' => $this->ataService->getCompetencia()->format('m'),
            'ano' => $this->ataService->getCompetencia()->format('Y'),
            'user_id' => Auth::user()->id,
            'tipo_arquivo_id' => Arquivo::FILE_ATA_TREINAMENT0,
            'processo_id' => \App\Services\AtaService::PROCESSO_ID,
            'arquivo' => 'public/treinamento/ata/' . $nomeArquivo
        ];

        $this->ataService->save($data);

        return redirect('/')->with('status', 'Ata enviada com sucesso!');
    }

    public function foto(Request $request) {
        $this->validate($request, [
            'foto' => 'required|file'
        ]);

        $validExtensions = ['jpg', 'png'];

        if (!in_array($request->file('foto')->getClientOriginalExtension(), $validExtensions)) {
            return back()->withErrors(['Formato de Arquivo inválido! Arquivos Permitidos ' .
                        implode(",", $validExtensions)]);
        }


        $nomeArquivo = sprintf("%s.%s", md5(microtime() .
                        Arquivo::FILE_FOTO_TREINAMENTO), $request->file('foto')->getClientOriginalExtension()
        );


        $request->file('foto')->storeAs('public/treinamento/foto/', $nomeArquivo);


        $data = [
            'mes' => $this->ataService->getCompetencia()->format('m'),
            'ano' => $this->ataService->getCompetencia()->format('Y'),
            'user_id' => Auth::user()->id,
            'tipo_arquivo_id' => Arquivo::FILE_FOTO_TREINAMENTO,
            'processo_id' => \App\Services\AtaService::PROCESSO_ID,
            'arquivo' => 'public/treinamento/foto/' . $nomeArquivo
        ];

        $this->ataService->save($data);

        return redirect('/')->with('status', 'Foto enviada com sucesso!');
    }

}
