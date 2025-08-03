@extends('layouts.app')

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                        {{ __('Painel de Administração') }}
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- Card Gerenciar Produtos --}}
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <h3 class="font-bold text-lg mb-2">Gerenciar Produtos</h3>
                            <p class="text-gray-600 mb-4">Adicione, edite ou remova produtos do seu catálogo.</p>
                            <a href="{{ route('admin.products.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver Produtos
                            </a>
                        </div>

                        {{-- Card Gerenciar Categorias (NOVO) --}}
                        <div class="bg-gray-100 p-4 rounded-lg shadow-sm">
                            <h3 class="font-bold text-lg mb-2">Gerenciar Categorias</h3>
                            <p class="text-gray-600 mb-4">Adicione, edite ou remova categorias do seu site.</p>
                            <a href="{{ route('admin.categories.index') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Ver Categorias
                            </a>
                        </div>

                        {{-- Você pode adicionar mais cards aqui para gerenciar pedidos, usuários, etc. --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection