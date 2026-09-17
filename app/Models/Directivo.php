<?php

namespace App\Models;

use App\Models\User;
use App\Models\Cargo;
use App\Models\Directiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Ulids\HasUlids;
use Illuminate\Database\Eloquent\Model;

class Directivo extends Model
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

    public function directiva()
    {
        return $this->belongsTo(Directiva::class);
    }

    
}
