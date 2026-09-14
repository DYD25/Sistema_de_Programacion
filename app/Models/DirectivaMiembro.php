<?php

namespace App\Models;

use app\Models\Iglesia;
use App\Models\User;
use App\Models\Cargo;
use App\Models\Directiva;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DirectivaMiembro extends Model
{
    use HasFactory;
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
