<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlbumController extends Controller
{
    public function album($user, $mes, $ano) {
        $album = new \App\Services\Util\Album($user, $mes, $ano);
        
        
        return view('admin.album.index', compact('album'));
    }
}