<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HistoryController extends Controller
{
    public function index() {
        $repository = new \App\Repositories\PontuacaoRepository();
        
        $today = new \DateTimeImmutable();
        $anoAtual = $today->format('Y');
        $mesAtual = $today->format('m');
        
        $atual = $repository->history(Auth::user()->id, $mesAtual, $anoAtual );
        
        $anoAnterior = $today->sub(new \DateInterval('P1M'))->format('Y');
        $mesAnterior = $today->sub(new \DateInterval('P1M'))->format('m');
        
        $anterior = $repository->history(Auth::user()->id, $mesAnterior, $anoAnterior );
        
        return view('history.index')->with(['atual' => $atual, 'anterior' => $anterior]);
    }
}
