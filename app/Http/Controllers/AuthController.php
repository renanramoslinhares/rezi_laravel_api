<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
    
        // Encontre o usuário pelo email
        $user = User::where('email', $request->email)->first();
    
        // Verifique se o usuário existe e se a senha está correta
        if ($user && Hash::check($request->password, $user->password)) {
            // Autenticação bem-sucedida
            Auth::login($user); // Faz login manualmente

            // Gerar um token para o usuário autenticado
            $token = $user->createToken('API_token123')->plainTextToken;

            return response()->json([
                'message' => 'Login bem-sucedido',
                'token' => $token,
                'user' => $user,
            ], 200);
        }
    
        // Se a autenticação falhar
        return response()->json([
            'message' => 'Credenciais inválidas',
        ], 401);
    }
}
