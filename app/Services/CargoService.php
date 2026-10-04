<?php

namespace App\Services;

use Exception;
use App\Repositories\CargoRepository;
use App\Services\ContextoService;

class CargoService
{

    public function __construct(
        protected CargoRepository $cargoRepository,
        protected ContextoService $contextoService)
    { }

    public function obtenerDatos(): array
    {    
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $cargos = $this->cargoRepository->listar($id_iglesia);
        return [
            'data' => $cargos
        ];
    }

    public function procesarParaGuardar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->cargoRepository->registrarCargo($data, $id_iglesia);
        return [
            'mensaje' => 'Cargo registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        if(empty($data['id_iglesia'])){
            return [
                'excepcion' => true,
                'mensaje' => 'Este cargo no se puede actualizar.',
            ];
        }

        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->cargoRepository->actualizarCargo($data, $id_iglesia);

        return [
            'mensaje' => 'Cargo actualizado correctamente.',
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
        if(empty($data['id_iglesia'])){
            return [
                'excepcion' => true,
                'mensaje' => 'Este cargo no se puede eliminar.',
            ];
        }

        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->cargoRepository->eliminarCargo($data['id'], $id_iglesia);
        return [
            'mensaje' => 'Cargo eliminado correctamente.' 
        ];
    }


}
