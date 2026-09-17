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

    public function seleccionar(string $iglesiaId): array
    {
        session([
            'iglesia_id' => $iglesiaId
        ]);

        return [
            'success' => true,
            'message' => 'Iglesia seleccionada correctamente.'
        ];
    }

      public function obtenerDatos(): array
    {    
        $iglesiaId = $this->IglesiaRepository->listar();
        return [
            'data' => $iglesiaId
        ];
    }

    public function procesarParaGuardar(array $data)
    {
       $this->IglesiaRepository->registrarIglesia($data);
        return [
            'mensaje' => 'Iglesia registrada correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $this->IglesiaRepository->actualizarIglesia($data);
        return [
            'mensaje' => 'Iglesia actualizada correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $this->IglesiaRepository->actualizarEstadoIglesia($data);
        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $this->IglesiaRepository->eliminarIglesia($data['id']);   
        return [
            'mensaje' => 'Iglesia eliminada correctamente.' 
        ];
    }
}