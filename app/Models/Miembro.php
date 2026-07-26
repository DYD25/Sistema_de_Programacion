<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use app\Models\Iglesia;

class Miembro extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function iglesia()
    {
        return $this->belongsTo(Iglesia::class);
    }
}
