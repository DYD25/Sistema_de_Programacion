<?php

namespace App\Livewire;
use App\Models\Miembro;
use Livewire\Component;
use Livewire\WithPagination;

class MiembrosTable extends Component
{
    use WithPagination;
    public function render()
    {
    
        return view('livewire.miembros-table', [
            'miembros' => Miembro::paginate(10)
        ]);
        
    }
}
