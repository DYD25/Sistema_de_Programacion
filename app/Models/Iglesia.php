<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Directiva;

class Iglesia extends Model
{
    use HasFactory;

    public function miembros()
    {
        return $this->hasMany(Miembro::class);
    }

    public function directivas()
    {
        return $this->hasMany(Directiva::class);
    }
}
