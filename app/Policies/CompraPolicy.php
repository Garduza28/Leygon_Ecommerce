<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Compra;

class CompraPolicy
{
    public function view(User $user, Compra $compra)
    {
        // Lógica para determinar si el usuario puede ver la compra
        return $user->id === $compra->user_id;
    }

    public function update(User $user, Compra $compra)
    {
        // Lógica para determinar si el usuario puede actualizar la compra
        return $user->id === $compra->user_id;
    }

    // Otros métodos de autorización según sea necesario
}
