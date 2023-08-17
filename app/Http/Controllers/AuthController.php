<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pessoa;


class AuthController extends Controller
{
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'senha' => 'required|min:5',
        ]);

        $email = $request->email;
        $senha = $request->senha;
        $userBd = Pessoa::select('id')->where('email', $email)->where('senha', $senha)->get()->first();

        if ($userBd) {
          return response()->json(['Usuário logado com sucesso!'], 200);
          
      }
      else {
        // O email não existe no banco de dados
        return response()->json(['message' => 'Erro ao fazer login, usuário ou senha inválidos'], 404);
    }

        
    }
}
