<?php

namespace App\Http\Controllers;

use App\Models\NivelModel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index()
    {
        return view('nivel.index');
    }

    public function ShowViewRegister(Request $request)
    {
        $id = 0 ;
        return view('nivel.create', compact('id'));
    }

    public function ShowViewEdit($id){
        $nivel = NivelModel::find($id);
        return view('nivel.create', compact('nivel', 'id'));
    }

}
