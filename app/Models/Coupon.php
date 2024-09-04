<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable = [
        'codigo',
        'descuento',
        'cantidad_disponible',
        '_token', // Agrega este campo
        // Agrega aquí los otros campos de tu modelo Coupon


    ];

    public function users()
{
    return $this->belongsToMany(User::class, 'user_coupon');
}

}
