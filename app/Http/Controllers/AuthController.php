<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'senha');


        if (auth()->attempt($credentials)) {
            return response()->json(['message' => 'Login com sucesso!']);
        } else {
            return response()->json(['message' => 'Falha ao logar'], 401);
        }
    }
}
