<?php

namespace App\Services;

use Exception;
use App\Repositories\DirectivaRepository;
use App\Services\ContextoService;

class DirectivaService
{

    public function __construct(
        
        protected DirectivaRepository $directivaRepository, protected ContextoService $contextoService)
    { }


    public function obtenerDatos(): array
    {    
        $directivas = $this->directivaRepository->listar();
        return [
            'data' => $directivas
        ];
    }

    public function procesarParaGuardar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
       $this->directivaRepository->registrarDirectiva($data,$id_iglesia);
        return [
            'mensaje' => 'Directiva registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->directivaRepository->actualizarDirectiva($data, $id_iglesia);
        return [
            'mensaje' => 'Directiva actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $this->directivaRepository->actualizarEstadoDirectiva($data);
        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $this->directivaRepository->eliminarDirectiva($data['id']);
        return [
            'mensaje' => 'Directiva eliminado correctamente.' 
        ];
    }


}
