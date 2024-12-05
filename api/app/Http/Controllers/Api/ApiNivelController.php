<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DevModel;
use App\Models\NivelModel;
use Illuminate\Http\Request;

class ApiNivelController extends Controller
{
    public function consultar()
    {
        try {
            $niveis = NivelModel::all();

            foreach ($niveis as $nivel){
                $qtd_devs = DevModel::where('nivel_id', $nivel->id)->get()->count();
                $nivel['qtd_devs'] = $qtd_devs;
            }

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

    public function create(Request $request)
    {
        try {
            $this->validateNivel($request);
            $data = $request->all();
            $nivel = new NivelModel();

            $nivel::create($data);

            return response()->json(['message' => 'Nível cadatrado com sucesso!'],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar Nível! ' . $e->getMessage()],400);
        }
    }

    public function update(Request $request, $id){
        try{
            $this->validateNivel($request);
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
            return response()->json(['message' => 'Erro ao excluir Nível! '.$e->getMessage()], 500);
        }

    }

    public function validateNivel($request)
    {
        $request->validate([
            'nivel' => 'required'
        ]);
    }

}
