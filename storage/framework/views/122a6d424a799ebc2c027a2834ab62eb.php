<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    <title><?php echo e(config('app.name', 'Laravel')); ?></title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
</head>
<body class="font-sans antialiased text-gray-800 bg-gray-100">

    <header class="bg-black text-white py-4 shadow-md">
        <div class="container mx-auto flex items-center justify-between px-4">
            <a href="<?php echo e(url('/')); ?>" class="flex items-center text-xl font-bold text-yellow-400 hover:text-yellow-300">
                <img src="<?php echo e(asset('images/logotipo_happy_nation.png')); ?>" alt="Happy Nation Logo" class="h-10 mr-3">
                Tabacaria Online
            </a>

            <div class="flex-grow max-w-lg mx-8">
                <div class="relative">
                    <input type="text" placeholder="Buscar produtos..." class="w-full py-2 pl-10 pr-4 rounded-full text-gray-800 focus:outline-none focus:ring-2 focus:ring-yellow-400">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                </div>
            </div>

            <nav class="flex items-center space-x-6">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(route('dashboard')); ?>" class="flex items-center text-white hover:text-yellow-400">
                        <svg class="h-6 w-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        Dashboard
                    </a>
                    <form method="POST" action="<?php echo e(route('logout')); ?>" class="inline">
                        <?php echo csrf_field(); ?>
                        <a href="#" onclick="event.preventDefault(); this.closest('form').submit();" class="text-white hover:text-yellow-400">Sair</a>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="flex items-center text-white hover:text-yellow-400">
                        <svg class="h-6 w-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"></path></svg>
                        Login
                    </a>
                    <a href="<?php echo e(route('register')); ?>" class="flex items-center text-white hover:text-yellow-400">Registrar</a>
                <?php endif; ?>
                <a href="#" class="flex items-center text-white hover:text-yellow-400">
                    <svg class="h-6 w-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    Carrinho (0)
                </a>
            </nav>
        </div>
    </header>

<nav class="bg-gray-800 text-white shadow-sm">
    <div class="container mx-auto flex justify-center py-2 space-x-6">
        <?php
            // Carrega as categorias diretamente na view.
            // Para aplicações maiores, um View Composer seria mais elegante.
            $categories = App\Models\Category::all();
        ?>

        <?php $__empty_1 = true; $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(url('/categorias/' . $category->slug)); ?>" class="px-3 py-1 hover:bg-gray-700 rounded-md">
                <?php echo e($category->name); ?>

            </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <a href="#" class="px-3 py-1 text-gray-400">Nenhuma categoria cadastrada</a>
        <?php endif; ?>
        
    </div>
</nav>

    <main class="container mx-auto mt-6 p-4 bg-white rounded-lg shadow-lg">
        <?php echo $__env->yieldContent('content'); ?>
    </main>

    <footer class="bg-gray-900 text-gray-300 py-8 mt-10">
        <div class="container mx-auto px-4 grid grid-cols-1 md:grid-cols-3 gap-8">
            <div>
                <h4 class="font-bold text-lg text-yellow-400 mb-3">Tabacaria Online</h4>
                <p class="text-sm">Seu destino para produtos de tabacaria de qualidade. <br>Compre com segurança e discrição.</p>
            </div>
            <div>
                <h4 class="font-bold text-lg text-yellow-400 mb-3">Links Úteis</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo e(route('home')); ?>" class="hover:text-yellow-300">Início</a></li>
                    <li><a href="<?php echo e(route('products.index')); ?>" class="hover:text-yellow-300">Produtos</a></li>
                    <li><a href="<?php echo e(route('login')); ?>" class="hover:text-yellow-300">Minha Conta</a></li>
                    <li><a href="#" class="hover:text-yellow-300">Contato</a></li>
                    <li><a href="#" class="hover:text-yellow-300">Política de Privacidade</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold text-lg text-yellow-400 mb-3">Contato e Social</h4>
                <p class="text-sm">Email: contato@tabacaria.com</p>
                <p class="text-sm">Telefone: (XX) XXXX-XXXX</p>
                <div class="flex space-x-4 mt-4">
                    <a href="#" class="text-gray-300 hover:text-yellow-400"><i class="fab fa-facebook-f"></i></a> <a href="#" class="text-gray-300 hover:text-yellow-400"><i class="fab fa-instagram"></i></a>
                    <a href="#" class="text-gray-300 hover:text-yellow-400"><i class="fab fa-twitter"></i></a>
                </div>
            </div>
        </div>
        <div class="text-center text-xs mt-8 border-t border-gray-700 pt-4">
            <p>&copy; <?php echo e(date('Y')); ?> Tabacaria Online. Todos os direitos reservados.</p>
            <p class="text-red-500 font-bold mt-2">AVISO: PROIBIDA A VENDA PARA MENORES DE 18 ANOS.</p>
        </div>
    </footer>
</body>
</html><?php /**PATH C:\xampp\htdocs\tabacaria-ecommerce\resources\views/layouts/app.blade.php ENDPATH**/ ?>