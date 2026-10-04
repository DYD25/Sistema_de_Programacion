<?php

namespace App\Services;

use App\Repositories\RolRepository;

class RolService
{

    public function __construct(
        protected RolRepository $rolRepository)
    { }

    public function obtenerDatos(): array
    {    
        $rol = $this->rolRepository->listar();
        return [
            'data' => $rol
        ];
    }

    public function procesarParaGuardar(array $data)
    {
       $this->rolRepository->registrarRol($data);
        return [
            'mensaje' => 'Rol registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $this->rolRepository->actualizarRol($data);
        return [
            'mensaje' => 'Rol actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $this->rolRepository->actualizarEstadoRol($data);
        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $this->rolRepository->eliminarRol($data['id']);
        return [
            'mensaje' => 'Rol eliminado correctamente.' 
        ];
    }

}
