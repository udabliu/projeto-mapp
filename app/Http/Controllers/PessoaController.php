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


    public function receberDados(Request $request)
    {
        $dados = $request->all();
        // Faça o processamento necessário dos dados recebidos
    
        return response()->json(['mensagem' => 'Dados recebidos com sucesso']);
    }
    
}


    //

