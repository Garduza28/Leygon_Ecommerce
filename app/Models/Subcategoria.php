<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    protected $fillable = ['id', 'nombre', 'nivel', 'clasification_id', 'productos_id'];

    public function clasification()
    {
        return $this->belongsTo(Clasifications::class, 'clasification_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
