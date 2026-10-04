<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use App\Models\Persona;

class Area extends Model
{
    use HasFactory;
    use HasUlids;
    
    public $incrementing = false;

    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function personas()
    {
        return $this->belongsToMany(Persona::class, 'personas_areas');
    }
    
}
