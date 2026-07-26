<?php

namespace App\View\Composers;

use Illuminate\View\View;
use App\Services\IglesiaService;

class NavbarComposer
{
    public function __construct(
        protected IglesiaService $service
    ) {}

    public function compose(View $view): void
    {
        $view->with([
            'iglesias' => $this->service->obtenerTodas(),
            'iglesiaSeleccionada' => session('iglesia_id')
        ]);
    }
}