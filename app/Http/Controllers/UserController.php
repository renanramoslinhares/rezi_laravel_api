<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        // Recupera todos os usuários da tabela
        $users = User::all();

        // Retorna a resposta como JSON
        return response()->json($users);
    }

    public function store(Request $request)
    {
        // Verifica se o email já está em uso
        $savedUser = User::where('email', $request->email)->first();
        if ($savedUser) {
            return response()->json([
                'message' => 'Email já está em uso.',
            ], 409);
        }

        // Validação dos dados de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Criação do usuário
        $createUser = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'message' => 'Usuário criado com sucesso',
            'user' => $createUser,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $request->validate([
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $id,
            'password' => 'sometimes|string|confirmed|min:8',
        ]);

        // Encontrar o usuário pelo ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        // Atualizar apenas os campos fornecidos
        $user->update($request->only(['name', 'email', 'password']));

        return response()->json([
            'message' => 'Usuário atualizado com sucesso',
            'user' => $user,
        ], 200);
    }

    public function destroy($id)
    {
        // Encontrar o usuário pelo ID
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        // Excluir o usuário
        $user->delete();

        return response()->json(['message' => 'Usuário excluído com sucesso'], 200);
    }
}
