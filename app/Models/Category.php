<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['id','nombre','nivel'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function clasificaciones()
    {
        return $this->hasMany(Clasifications::class, 'category_id');
    }
}