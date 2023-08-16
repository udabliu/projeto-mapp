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

    public function cadastrarPessoa(Request $request){
        
        //validator da forma que o chatgpt passou
        $validator = Validator::make($request->all(), [
            'nome' => 'required|min:5|max:40',
            'email' => 'required|email|unique:pessoas,email',
            'senha' => 'required|min:5'
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }else{
        $pessoa = new Pessoa;
        $pessoa->nome = $request->nome;
        $pessoa->email = $request->email;
        $pessoa->senha = $request->senha;
        $pessoa->telefone = $request->telefone;

        $pessoa->save();
        return response()->json($pessoa);
        }
   
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'senha');

        // Faça a validação dos campos, se necessário

        if (auth()->attempt($credentials)) {
            return response()->json(['message' => 'Login com sucesso!']);
        } else {
            return response()->json(['message' => 'Falha ao logar'], 401);
        }
    }
}


    //

