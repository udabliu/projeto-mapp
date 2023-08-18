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
            //** essa mensagem é mostrada apenas no postman e nao como algo visual no front */
            return response()->json(['Erro de Validação dos dados' => $validator->errors()], 400);
        } else {
            $pessoa = new Pessoa;
            $pessoa->nome = $request->nome;
            $pessoa->email = $request->email;
            $pessoa->senha = $request->senha;
            $pessoa->telefone = $request->telefone;

            $pessoa->save();
            return response()->json("Usuário Cadastrado com Sucesso");
        }
    }
}


    //
