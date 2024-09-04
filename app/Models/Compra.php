<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    protected $fillable = ['data', 'estatus']; // Asegúrate de incluir 'estatus' en los campos asignables masivamente

    // Establecer valor por defecto para el campo 'estatus'
    protected $attributes = [
        'estatus' => 'Pendiente',
    ];
    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación inversa con el modelo User para obtener todos los campos del usuario
    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id')->withDefault();
    }
// En el modelo Compra
public function devolucion()
{
    return $this->hasOne(Devolucion::class);
}

    public function compra()
{
    return $this->belongsTo(Compra::class, 'compra_id');
}
}
