@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                            {{ __('Gerenciar Categorias') }}
                        </h2>
                        <a href="{{ route('admin.categories.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Adicionar Nova Categoria
                        </a>
                    </div>

                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <strong class="font-bold">Sucesso!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Ações</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($categories as $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->id }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->name }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $category->slug }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</a>
                                            <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Tem certeza que deseja excluir esta categoria? Isso pode afetar produtos associados.')">Excluir</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">Nenhuma categoria cadastrada.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection