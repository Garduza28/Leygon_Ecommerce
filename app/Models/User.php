<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name','apellido', 'email', 'password', 'role', 'tipo_usuario','direccion', 'numero_telefono', 'calle',
        'estado', 'codigo_postal', 'municipio', 'pais', 'exterior_interior', 'instrucciones','token', 'image_url', // Se agregó 'image_url' aquí
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relación uno a muchos con el modelo Envio.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function envios()
    {
        return $this->hasMany(Envio::class);
    }

    /**
     * Relación uno a muchos con el modelo Comment.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación uno a muchos con el modelo Compra.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function compras()
    {
        return $this->hasMany(Compra::class);
    }

    public function coupons()
{
    return $this->belongsToMany(Coupon::class, 'user_coupon');
}

}
