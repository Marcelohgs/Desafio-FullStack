<?php

namespace App\Http\Controllers;

use App\Models\DevModel;
use App\Models\NivelModel;
use Illuminate\Http\Request;

class NivelController extends Controller
{
    public function index()
    {
        return view('nivel.index');
    }

    public function consultar()
    {
        try {
            $niveis = NivelModel::all();

            if (empty($niveis)) {
                return response()->json(['message' => 'Nenhum nível cadastrado.'], 404);
            }

            $response = [
                'data' => $niveis
            ];

            return response()->json($response,200);
        }catch (\Exception $e){
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    public function ShowViewRegister(Request $request)
    {
        $id = 0 ;
        return view('nivel.create', compact('id'));
    }

    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $nivel = new NivelModel();

            $nivel::create($data);

            return response()->json(['message' => 'Nível cadatrado com sucesso!'],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar Nível! ' . $e->getMessage()],400);
        }
    }

    public function ShowViewEdit($id){
        try{
            $nivel = NivelModel::find($id);
            return view('nivel.create', compact('nivel', 'id'));
        }catch(\Exception $e){
            \Session::flash('mensagem', ['msg' => 'Erro ao editar Nível! '.$e->getMessage(), 'class' => 'alert-danger']);
        }
    }

    public function update(Request $request, $id){
        try{
            $data = $request->all();
            $nivel = NivelModel::find($id);

            $nivel->update($data);

            return response()->json(['message' => 'Nível atualizado com sucesso!'],200);
        }catch(\Exception $e){
            return response()->json(['message' => 'Erro ao atualizar Nível! ' . $e->getMessage()],400);
        }
    }

    public function delete($id){
        try{

            $nivel = NivelModel::findOrFail($id);

            $dev_exists = DevModel::where('nivel_id', $id)->get()->count() == 0;

            // Verificar se o nível pode ser deletado
            if (!$dev_exists) {
                return response()->json(['message' => 'Este nível não pode ser excluído porque está vinculado a um Desenvolvedor.'], 400);
            }

            $nivel->delete();
            return response()->json(['message' => 'Nível excluido com sucesso.'], 204);
        }catch(\Exception $e){
            return response()->json(['message' => 'Erro ao excluir Nível!'], 500);
        }

    }

}
