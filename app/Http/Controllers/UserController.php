<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function store(Request $request)
    {
        $savedUser = User::where('email', $request->email)->first();
        if($savedUser) {
            return response()->json([
                'message' => 'Email já está em uso.',
            ], 409);
        }

        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email', // Verifica se o email já existe
            'password' => 'required|string|min:8|confirmed', // Confirmação de senha
        ]);

        // Criação do usuário
        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password), // Criptografa a senha
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'user' => $createUser,
        ], 201);
    }
}
