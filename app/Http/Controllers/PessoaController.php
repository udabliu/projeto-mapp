<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;



class PessoaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function cadastrarPessoa(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|max:40',
            'email' => 'required|email|unique:pessoas,email',
            'senha' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json(['Erro de Validação dos dados' => $validator->errors()], 400);
        } else {
            $pessoa = new Pessoa;
            $pessoa->nome = $request->nome;
            $pessoa->email = $request->email;
            $pessoa->senha = $request->senha;
            $pessoa->telefone = $request->telefone;

            $pessoa->save();
            return response()->json("Usuário Cadastrado com Sucesso!");
        }
    }
    //-------------------------------------------------------------------------------------------------------
    public function mostrar()
    {
        $pessoas = Pessoa::all();
        return response()->json($pessoas);
    }


    public function mostrarUm($id)
    {
        $pessoa = Pessoa::find($id);
        return response()->json($pessoa);
    }

    //-----------------------------------------------------------------------------------------------------------
    public function deletar($id)
    {
        $pessoa = Pessoa::find($id);

        if ($pessoa) {
            $pessoa->delete();

            return response()->json("Usuário Apagado com Sucesso!");
        } else {
            return response()->json("Erro ao Deletar");
        }
    }
    //----------------------------------------------------------------------
    public function editar(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'max:40',
            'senha' => 'min:5'
        ]);
        if ($validator->fails()) {
            return response()->json(['Erro de Validação dos dados' => $validator->errors()], 400);
        } else {


            $pessoa = Pessoa::find($id);

            if ($pessoa) {
                if ($pessoa->id == $request->id) {
                    $pessoa->nome = $request->nome;
                    $pessoa->senha = $request->senha;
                    $pessoa->telefone = $request->telefone;

                    $pessoa->save();
                    return response()->json("Dado(s) atualizado(s) com Sucesso" . $pessoa);
                } else {
                    return response()->json("Erro ao alterar dados: IDs não coincidem");
                }
            } else {
                return response()->json("Erro ao alterar dados: Pessoa não encontrada");
            }
        }
    }
};

    //
