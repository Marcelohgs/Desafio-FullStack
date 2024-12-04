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

    public function consultar()
    {
        try {
            $devs = DevModel::with('nivel')->get();

            if (empty($devs)) {
                return response()->json(['message' => 'Nenhum Desenvolvedor cadastrado.'], 404);
            }

            $response = [
                'data' => $devs
            ];

            return response()->json($response,200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function ShowViewRegister(Request $request)
    {
        $niveis = NivelModel::all();
        $id = 0 ;
        return view('dev.create', compact('id', 'niveis'));
    }

    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $dev = new DevModel();

            $dev::create($data);

            return response()->json(['message' => 'Desenvolvedor cadastrado com sucesso!'],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar Desenvolvedor! ' . $e->getMessage()],400);
        }
    }

public function ShowViewEdit($id){
        $dev = DevModel::find($id);
        $niveis = NivelModel::all();
        return view('dev.create', compact('dev', 'id', 'niveis'));
}

    public function update(Request $request, $id){
        try{
            $data = $request->all();
            $dev = DevModel::find($id);

            $dev->update($data);

            return response()->json(['message' => 'Desenvolvedor atualizado com sucesso!'],200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Erro ao atualizar Desenvolvedor! ' . $e->getMessage()],400);
        }
    }

    public function delete($id){
        try{
            $dev = DevModel::find($id);
            $dev->delete();

            return response()->json(['message' => 'Desenvolvedor excluido com sucesso!'], 204);
        }catch(\Exception $e){
            return response()->json(['message' => 'Erro ao excluir Desenvolvedor!'], 400);
        }
    }

}
