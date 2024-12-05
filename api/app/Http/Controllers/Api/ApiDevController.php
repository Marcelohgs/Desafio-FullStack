<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\DevModel;
use Illuminate\Http\Request;

class ApiDevController extends Controller
{
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

    public function create(Request $request)
    {
        try {
            $this->validateFields($request);

            $data = $request->all();
            $dev = new DevModel();

            $dev::create($data);

            return response()->json(['message' => 'Desenvolvedor cadastrado com sucesso!'],201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar Desenvolvedor! ' . $e->getMessage()],400);
        }
    }

    public function update(Request $request, $id){
        try{
            $this->validateFields($request);

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
            return response()->json(['message' => 'Erro ao excluir Desenvolvedor! '.$e->getMessage()], 400);
        }
    }

    public function validateFields($request){
        $request->validate([
            'nome' => 'required',
            'data_nascimento' => 'required|date',
            'hobby' => 'required',
            'nivel_id' => 'required'
        ]);
    }

}
