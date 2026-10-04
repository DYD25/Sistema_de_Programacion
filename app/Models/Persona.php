<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Area;



class Persona extends Model
{
    use HasFactory;
    use HasUlids;
    
    public $incrementing = false;

    protected $keyType = 'string';
    protected $guarded = ['id'];

    protected $appends = ['nombre_completo'];

    public function getNombreCompletoAttribute()
    {
        return "{$this->nombres} {$this->apellidos}";
    }

    public function areas()
    {
        return $this->belongsToMany(Area::class, 'persona_areas');
    }

}