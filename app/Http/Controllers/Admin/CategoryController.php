<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category; // Importe o modelo Category
use Illuminate\Http\Request;
use Illuminate\Support\Str; // Para gerar o slug

class CategoryController extends Controller
{
    /**
     * Exibe uma listagem do recurso (todas as categorias).
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Mostra o formulário para criar uma nova categoria.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Armazena uma nova categoria no armazenamento.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name', // Nome único
        ]);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name), // Gera um slug automaticamente
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Categoria criada com sucesso!');
    }

    /**
     * Mostra o formulário para editar a categoria.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Atualiza a categoria no armazenamento.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            // Ignora o nome atual para validação de unicidade ao editar
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    /**
     * Remove a categoria do armazenamento.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Categoria excluída com sucesso!');
    }
}