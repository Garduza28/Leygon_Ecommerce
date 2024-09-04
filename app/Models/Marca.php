<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    protected $fillable = ['id', 'nombre', 'nivel'];

    public function products()
    {
        return $this->hasMany(Product::class); // Cambiar belongsToMany a hasMany
    }

    public function clasificaciones()
    {
        return $this->hasMany(Clasifications::class, 'category_id');
    }
}
