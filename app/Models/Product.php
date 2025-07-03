<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category; // Adicione esta linha se não existir

class Product extends Model
{
    use HasFactory;

    // Adicione 'category_id' aqui para que ele possa ser atribuído em massa
    protected $fillable = [
        'name',
        'description',
        'price',
        'image',
        'category_id',
    ];

    /**
     * Define o relacionamento: Um produto pertence a uma Categoria.
     * (Um para muitos inverso)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}