<?php

namespace App\Http\Controllers;

use App\Models\Page; // Certifique-se de importar o modelo Page
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // Recupera todas as páginas da tabela
        $pages = Page::all();

        // Retorna a resposta como JSON
        return response()->json($pages);
    }
}
