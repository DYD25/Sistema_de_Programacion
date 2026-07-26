<?php

namespace App\Repositories;

use App\Models\Iglesia;

class IglesiaRepository
{
    public function obtenerTodas()
    {
        return Iglesia::orderBy('nombre')->get();
    }
}