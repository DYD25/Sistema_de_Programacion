<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class PersonaArea extends Model
{
    use HasFactory;
    use HasUlids;
    
    public $incrementing = false;

    protected $keyType = 'string';
    protected $guarded = ['id'];
}
