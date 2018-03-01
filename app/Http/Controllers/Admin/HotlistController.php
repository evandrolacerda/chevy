<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HotlistController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request ) {

        $mes = date('m');
        $ano = date('Y');
        
        if( $request->query('mes'))
        {
            $mes = $request->query('mes');
        }
        
        if( $request->query('ano'))
        {
            $ano = $request->query('ano');
        }
        
        $hotlists = \App\HotlistProcessamento::where('mes', $mes)
                ->where('ano', $ano )
                ->latest()
                ->paginate(30);
        
        return view('admin.hotlist.index', compact('hotlists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.hotlist.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $this->validate($request, [
            'mes' => "required|min:1|max:12",
            'ano' => "required",
            'planilha' => "required|file"
        ]);


        try {
            $handles = new \App\Services\Util\CSVFileHandler();

            $file = $request->file('planilha');
            $mes = $request->input('mes');
            $ano = $request->input('ano');

            $response = $handles->handle($file, $mes, $ano);
            if (is_array($response)) {
                return back()->withErrors($response);
            }

            if ($response > 0) {
                return back()->with('status', "Foram processados {$response} usuário(s)");
            }
        } catch (\Exception $ex) {
            return back()->withErrors(["Houve um erro ao processar o arquivo. Verifique se a competência já não foi processada."]);
                
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
