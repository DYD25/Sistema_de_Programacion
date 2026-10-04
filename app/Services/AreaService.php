<?php

namespace App\Services;

use App\Repositories\AreaRepository;
use App\Services\ContextoService;

class AreaService
{

    public function __construct(
        
        protected AreaRepository $areaRepository, protected ContextoService $contextoService)
    { }


    public function obtenerDatos(): array
    {        
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $areas = $this->areaRepository->listar($id_iglesia);
        return [
            'data' => $areas
        ];
    }

    public function procesarParaGuardar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->areaRepository->registrarArea($data,$id_iglesia);
        return [
            'mensaje' => 'Area registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->areaRepository->actualizarArea($data, $id_iglesia);
        return [
            'mensaje' => 'Area actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $this->areaRepository->actualizarEstadoArea($data);
        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $this->areaRepository->eliminarArea($data['id']);
        return [
            'mensaje' => 'Area eliminado correctamente.' 
        ];
    }

    public function procesarParaConsultar()
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $areas = $this->areaRepository->obtenerAreas($id_iglesia);
        return [
            'data' => $areas
        ];
    }
    
    public function procesarParaAsignar(array $data)
    {
        if (!isset($data['areas'])) {
            return [
                'excepcion' => true,
                'mensaje' => 'Por favor, seleccione al menos una área',
            ];
        }

        $this->areaRepository->asignarAreas($data);
        return [
            'mensaje' => 'Areas asignadas correctamente.'
        ];
    }
    

}
