<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Devolucion extends Model
{
    use HasFactory;

    // Atributos que se pueden asignar en masa
    protected $fillable = [
        'compra_id', // ID de la compra relacionada
        'user_id',   // ID del usuario que solicitó la devolución
        'motivo',    // Motivo de la devolución
        'reason',    // Motivo de la devolución
    ];

    // Relación con el modelo Compra
    public function compra()
    {
        return $this->belongsTo(Compra::class, 'compra_id');
    }

    // Relación con el modelo User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    // Relación con el modelo Devolucion
public function devolucion()
{
    return $this->hasOne(Devolucion::class);
}

}
