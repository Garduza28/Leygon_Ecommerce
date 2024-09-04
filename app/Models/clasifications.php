<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clasifications extends Model
{
    use HasFactory;

    protected $fillable = ['id', 'nombre', 'nivel', 'category_id'];

    public function products()
    {
        return $this->hasMany(Product::class, 'clasification_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
