<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo', 'producto_id', 'modelo', 'total_existencia', 'brand_id', 'sat_key', 'img_portada',
        'precio', 'descripcion', 'marca_logo', 'descuento', 'existencia_nuevo', 'category_id',
        'clasification_id', 'subcategoria_id'
    ];

// En tu modelo Product
public function category()
{
    return $this->belongsTo(Category::class, 'categoria_id');
}

    public function brands()
    {
        return $this->belongsTo(Brand::class);
    }

    public function classification()
    {
        return $this->belongsTo(Clasifications::class, 'clasification_id');
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class, 'subcategoria_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
