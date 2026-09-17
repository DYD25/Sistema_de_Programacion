<?php

namespace App\Services;

use Exception;
use App\Repositories\CargoRepository;
use App\Services\ContextoService;

class CargoService
{

    public function __construct(
        protected CargoRepository $cargoRepository)
    { }

    public function obtenerDatos(): array
    {    
        $directivas = $this->cargoRepository->listar();
        return [
            'data' => $directivas
        ];
    }

    public function procesarParaGuardar(array $data)
    {
       $this->cargoRepository->registrarCargo($data);
        return [
            'mensaje' => 'Cargo registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $this->cargoRepository->actualizarCargo($data);
        return [
            'mensaje' => 'Cargo actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $this->cargoRepository->actualizarEstadoCargo($data);
        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $this->cargoRepository->eliminarCargo($data['id']);
        return [
            'mensaje' => 'Cargo eliminado correctamente.' 
        ];
    }


}
