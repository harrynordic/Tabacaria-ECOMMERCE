@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                        {{ __('Adicionar Novo Produto') }}
                    </h2>

                    {{-- Exibe erros de validação --}}
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

                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf {{-- Proteção contra Cross-Site Request Forgery (CSRF) --}}

                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nome do Produto</label>
                            {{-- 'old('name')' preenche o campo com o valor anterior em caso de erro de validação --}}
                            <input type="text" name="name" id="name" value="{{ old('name') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descrição</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">{{ old('description') }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Categoria</label>
                            <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sem Categoria</option> {{-- Opção para não atribuir categoria --}}
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                            @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="price" class="block text-sm font-medium text-gray-700">Preço (R$)</label>
                            <input type="number" step="0.01" name="price" id="price" value="{{ old('price') }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Imagem do Produto</label>
                            {{-- 'type="file"' é para upload de arquivos, 'enctype="multipart/form-data"' é crucial no form --}}
                            <input type="file" name="image" id="image" class="mt-1 block w-full text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer focus:outline-none">
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Salvar Produto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection