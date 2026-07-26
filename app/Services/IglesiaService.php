<?php

namespace App\Services;

use App\Repositories\IglesiaRepository;

class IglesiaService
{
    public function __construct(
        protected IglesiaRepository $IglesiaRepository
    ) {}

    public function obtenerTodas()
    {
        return $this->IglesiaRepository->obtenerTodas();
    }

    public function seleccionar(int $iglesiaId): array
{
    session([
        'iglesia_id' => $iglesiaId
    ]);

    return [
        'success' => true,
        'message' => 'Iglesia seleccionada correctamente.'
    ];
}
}