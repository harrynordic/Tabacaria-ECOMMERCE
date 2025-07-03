<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Exibe uma listagem do recurso (todos os produtos).
     */
    public function index()
    {
        $products = Product::all(); // Pega todos os produtos do banco de dados
        return view('admin.products.index', compact('products')); // Passa os produtos para a view
    }

    /**
     * Mostra o formulário para criar um novo recurso (produto).
     */
    public function create()
    {
        $categories = Category::all(); // Pega todas as categorias do banco de dados
        return view('admin.products.create', compact('categories')); // Passa para a view 'create'
    }


    /**
     * Armazena um recurso recém-criado no armazenamento (banco de dados).
     */
    public function store(Request $request)
    {
        // 1. Validação dos dados do formulário
        // 'required': Campo obrigatório
        // 'string': Deve ser uma string
        // 'max:255': Máximo de 255 caracteres
        // 'nullable': Pode ser nulo (vazio)
        // 'numeric': Deve ser um número
        // 'min:0.01': Valor mínimo de 0.01
        // 'image': Deve ser um arquivo de imagem
        // 'max:2048': Tamanho máximo de 2048 KB (2 MB)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|max:2048', // 2MB max, apenas imagens
            'category_id' => 'nullable|exists:categories,id'
        ]);

        // 2. Lidar com o upload da imagem (se o arquivo foi enviado)
        $imagePath = null;
        if ($request->hasFile('image')) { // Verifica se um arquivo 'image' foi enviado
            // Armazena a imagem na pasta 'products' dentro de 'storage/app/public'
            // e retorna o caminho relativo do arquivo (ex: products/nomedaimagemunica.jpg).
            // 'public' é o disco de armazenamento configurado para ser acessível publicamente.
            $imagePath = $request->file('image')->store('products', 'public');
        }

        // 3. Criar um novo registro de produto no banco de dados
        Product::create([
            'name' => $request->name, // Pega o valor do campo 'name' do formulário
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // Salva o caminho da imagem no banco de dados
            'category_id' => $request->category_id,
        ]);

        // 4. Redirecionar o usuário de volta para a lista de produtos com uma mensagem de sucesso
        return redirect()->route('admin.products.index')->with('success', 'Produto criado com sucesso!');
    }

    /**
     * Exibe o recurso especificado (um único produto).
     * (Não usaremos esta rota show() para o painel admin de produtos por enquanto,
     * já que index() lista todos e edit() mostra os detalhes para edição.
     * É mais comum em APIs ou no front-end para detalhes do produto.)
     */
    public function show(string $id)
    {
        // return view('admin.products.show', ['product' => Product::findOrFail($id)]);
    }

    /**
     * Mostra o formulário para editar o recurso especificado (um produto existente).
     * Laravel faz "injeção de dependência": ele automaticamente encontra o Produto pelo ID
     * passado na URL e injeta o objeto Product.
     */
    public function edit(Product $product)
    {
        $categories = Category::all(); // Pega todas as categorias do banco de dados
        return view('admin.products.edit', compact('product', 'categories')); // Passa para a view 'edit'
    }
    /**
     * Atualiza o recurso especificado no armazenamento (banco de dados).
     */
    public function update(Request $request, Product $product)
    {
        // 1. Validação dos dados (similar ao store)
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0.01',
            'image' => 'nullable|image|max:2048',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        // 2. Lidar com a imagem (nova imagem, manter existente, ou deletar)
        $imagePath = $product->image; // Inicia com o caminho da imagem atual do produto

        if ($request->hasFile('image')) {
            // Se uma nova imagem foi enviada, deleta a antiga (se existir)
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            // Armazena a nova imagem
            $imagePath = $request->file('image')->store('products', 'public');
        } elseif ($request->input('delete_image_checkbox')) { // Verifica se o checkbox de deletar imagem foi marcado
            // Se o checkbox foi marcado, deleta a imagem antiga
             if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
            $imagePath = null; // Define o caminho da imagem como nulo no banco de dados
        }


        // 3. Atualizar os atributos do produto no banco de dados
        $product->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath, // Atualiza com o novo caminho ou null
            'category_id' => $request->category_id,
        ]);

        // 4. Redirecionar com mensagem de sucesso
        return redirect()->route('admin.products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    /**
     * Remove o recurso especificado do armazenamento (banco de dados).
     */
    public function destroy(Product $product) // Injeção de dependência: Laravel encontra o produto
    {
        // Deleta a imagem associada do disco, se existir
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete(); // Deleta o registro do produto do banco de dados
        return redirect()->route('admin.products.index')->with('success', 'Produto excluído com sucesso!');
    }
}