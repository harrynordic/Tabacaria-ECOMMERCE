<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product; // Importe o modelo Product

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Cigarro X - Maço',
            'description' => 'Maço de cigarros premium com filtro.',
            'price' => 12.50,
            'image' => 'products/cigarro_x.jpg', // Exemplo de caminho de imagem
        ]);

        Product::create([
            'name' => 'Charuto Y - Unidade',
            'description' => 'Charuto artesanal, sabor suave.',
            'price' => 35.00,
            'image' => 'products/charuto_y.jpg',
        ]);

        Product::create([
            'name' => 'Fumo de rolo Z - 50g',
            'description' => 'Fumo natural para enrolar.',
            'price' => 22.00,
            'image' => null, // Sem imagem por enquanto
        ]);
    }
}