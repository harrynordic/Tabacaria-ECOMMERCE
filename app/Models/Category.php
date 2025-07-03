<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product; // Adicione esta linha se não existir

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];

    /**
     * Define o relacionamento: Uma Categoria tem muitos Produtos.
     * (Um para muitos)
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}