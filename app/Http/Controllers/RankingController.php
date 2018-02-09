<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RankingController extends Controller
{
    public function index() {
        
        $repository = new \App\Repositories\PontuacaoRepository();
        
        $hoje = new \DateTimeImmutable();
        $mesAtual = $hoje->format('m');
        $anoAtual = $hoje->format('Y');
        
        $rankingAtual = $repository->ranking( $mesAtual, $anoAtual)->sortBy('total');
        
        $competencia = $hoje->sub(new \DateInterval('P1M'));
        
        $rankingAnterior = $repository->ranking( $competencia->format('m'), $competencia->format('Y'));
        
        //dd( $ranking );
                
        
                
        return view('ranking.index', [
                'ranking' => $rankingAtual, 
                'mesAtual' => $mesAtual,
                'anterior' => $rankingAnterior, 
                'mes_anterior' => $competencia->format('m')
                ]);
    }
}
