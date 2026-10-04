<?php

namespace App\Services;

use Exception;
use App\Repositories\PermisoRepository;

class PermisoService
{

    public function __construct(
        protected PermisoRepository $permisoRepository)
    { }

    public function obtenerDatos(): array
    {    
        $permiso = $this->permisoRepository->listar();
        return [
            'data' => $permiso
        ];
    }
    
    public function consultarPermisos(): array
    {
        return $this->permisoRepository->listarPermisos();
    }


    public function procesarParaGuardar(array $data)
    {
       $this->permisoRepository->registrarPermiso($data);
        return [
            'mensaje' => 'Permiso registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $this->permisoRepository->actualizarPermiso($data);
        return [
            'mensaje' => 'Permiso actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $this->permisoRepository->actualizarEstadoPermiso($data);
        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $this->permisoRepository->eliminarPermiso($data['id']);
        return [
            'mensaje' => 'Permiso eliminado correctamente.' 
        ];
    }

}
