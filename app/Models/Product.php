<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'brand',
        'color',
        'price',
        'description',
        'stock',
        'image',
        'category_id',
        'slug', // Agregar slug al $fillable
    ];
    
    // Relación con la categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Generar el slug automáticamente al crear un nuevo producto
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($product) {
            // Genera el slug a partir del nombre del producto
            $product->slug = Str::slug($product->name);
        });
    }
}
