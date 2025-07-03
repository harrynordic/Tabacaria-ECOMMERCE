<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category; // Importe o modelo Category
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function indexByCategory($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();
        $products = $category->products; // Pega os produtos relacionados à categoria

        // Passa tanto os produtos quanto a categoria para a view products.index
        return view('products.index', compact('products', 'category'));
    }
}