<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cargo;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Directiva extends Model
{
    use HasFactory;
    use HasUlids;
    
    public $incrementing = false;

    protected $keyType = 'string';
    protected $guarded = ['id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }

    public function cargo()
    {
        return $this->belongsTo(Cargo::class);
    }

    
}
