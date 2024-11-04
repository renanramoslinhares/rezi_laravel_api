<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index()
    {
        // Recupera todas as páginas da tabela
        $pages = Page::all();

        // Retorna a resposta como JSON
        return response()->json($pages);
    }

    public function store(Request $request)
    {
        // Validação dos dados de entrada
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'status' => 'required|in:draft,published,archived', // valida os status permitidos
        ]);

        // Criação da página
        $page = Page::create([
            'title' => $request->title,
            'content' => $request->content,
            'status' => $request->status,
            'user_id' => Auth::id(),
        ]);

        return response()->json([
            'message' => 'Página criada com sucesso',
            'page' => $page,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        // Validação dos dados de entrada
        $request->validate([
            'title' => 'sometimes|string|max:255',  // 'sometimes' para tornar o campo opcional
            'content' => 'sometimes|string',
            'status' => 'sometimes|in:draft,published,archived', // apenas status permitidos
        ]);

        // Encontrar a página para atualizar
        $page = Page::find($id);

        if (!$page) {
            return response()->json(['message' => 'Página não encontrada'], 404);
        }

        // Atualizar os campos
        $page->update($request->only(['title', 'content', 'status']));

        return response()->json([
            'message' => 'Página atualizada com sucesso',
            'page' => $page,
        ], 200);
    }

    public function destroy($id)
    {
        // Verificar se a página existe
        $page = Page::find($id);

        if (!$page) {
            return response()->json(['message' => 'Página não encontrada'], 404);
        }

        // Excluir a página
        $page->delete();

        return response()->json(['message' => 'Página excluída com sucesso'], 200);
    }
}
