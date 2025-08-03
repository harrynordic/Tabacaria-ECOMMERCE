@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('Editar Produto: ' . $product->name) }}
                    </h2>

                    @if ($errors->any())
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Opa!</strong>
                            <span class="block sm:inline">Há alguns problemas com seus dados.</span>
                            <ul class="mt-3 list-disc list-inside text-sm">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- O método HTTP é POST, mas @method('PUT') simula o PUT para o Laravel --}}
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Indica que esta é uma requisição PUT (para atualização) --}}

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                            {{-- 'old('name', $product->name)' tenta pegar o valor anterior, senão o valor do DB --}}
                            <input type="text" name="name" id="name" value="{{ old('name', $product->name) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description', $product->description) }}</textarea>
                        </div>
                        
                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                            <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sem Categoria</option>
                                @foreach($categories as $category)
                                {{-- Aqui usamos old('category_id', $product->category_id) para que a categoria atual do produto seja pré-selecionada --}}
                                    <option value="{{ $category->id }}" {{ (old('category_id', $product->category_id) ==                $category->id) ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
<                       /div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price', $product->price) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Imagem Atual</label>
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="mt-2 h-20 w-20 object-cover rounded-md">
                                <div class="mt-2 flex items-center">
                                    <input type="checkbox" name="delete_image_checkbox" id="delete_image_checkbox" class="h-4 w-4 text-red-600 focus:ring-red-500 border-gray-300 rounded">
                                    <label for="delete_image_checkbox" class="ml-2 text-sm text-gray-700">Remover imagem atual</label>
                                </div>
                            @else
                                <p class="text-sm text-gray-500 mt-2">Nenhuma imagem cadastrada.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Nova Imagem do Produto (Opcional)</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:ring-offset-2 transition ease-in-out duration-150">
                                Atualizar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection