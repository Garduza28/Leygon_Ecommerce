<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Envio extends Model
{
    protected $fillable = [
        'first_name',
        'last_name',
        'address',
        'street_number',
        'city',
        'country',
        'state',
        'postal_code',
        'delivery_instructions', 
    ];

    /**
     * Relación muchos a uno con el modelo User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Resto del contenido del modelo
}