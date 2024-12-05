<?php

namespace App\Http\Controllers;

use App\Models\DevModel;
use App\Models\NivelModel;
use Illuminate\Http\Request;

class DevController extends Controller
{
    public function index()
    {
        return view('dev.index');
    }

    public function ShowViewRegister(Request $request)
    {
        $niveis = NivelModel::all();
        $id = 0 ;
        return view('dev.create', compact('id', 'niveis'));
    }

public function ShowViewEdit($id)
    {
        $dev = DevModel::find($id);
        $niveis = NivelModel::all();
        $nivelSelecionado = $dev->nivel_id;
        return view('dev.create', compact('dev', 'id', 'niveis', 'nivelSelecionado'));
    }

}
