<?php

namespace App\Services;

use Exception;
use App\Repositories\DirectivoRepository;
use App\Services\ContextoService;

class DirectivoService
{

    public function __construct(
        protected DirectivoRepository $directivoRepository, protected ContextoService $contextoService)
    { }

    public function obtenerDatos(): array
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        if (!$id_iglesia) {
            return [];
        }
     
        $directivas = $this->directivoRepository->listar($id_iglesia);

        return [
            'data' => $directivas
        ];
    }

    public function obtenerDirectivas(): array
    {
        $directivas = $this->directivoRepository->listarDirectivas();

        return [
            'data' => $directivas
        ];
    }

    public function obtenerCargos(): array
    {
        $cargos = $this->directivoRepository->listarCargos();

        return [
            'data' => $cargos
        ];
    }

    public function procesarParaGuardar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $respusta_directiva =  $this->validarCargaDirectivaExistente($data['id_cargo'], $data['id_directiva'], $id_iglesia);
        if($respusta_directiva) return $respusta_directiva;

        $respusta_usuario =  $this->validarUsuarioExistente($data['correo'], false);
        if($respusta_usuario) return $respusta_usuario;
        
        $id_usuario = $this->directivoRepository->registrarUsuario($data);
        $this->directivoRepository->guardarDirectivo($data, $id_iglesia,$id_usuario);

        return [
            'mensaje' => 'Integrante de la directiva, registrado correctamente.'
        ];
    }

    public function procesarParaActualizar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $respusta_directiva =  $this->validarCargaDirectivaExistente($data['id_cargo'], $data['id_directiva'], $id_iglesia);
        if($respusta_directiva) return $respusta_directiva;

        $respusta_usuario =  $this->validarUsuarioExistente($data['correo'], true);
        if($respusta_usuario) return $respusta_usuario;
        
        $this->directivoRepository->actualizarDirectivo($data, $id_iglesia);
        $this->directivoRepository->actualizarDatoCargo('name', $data['nombre'], $data['correo']);

        if(!empty($data['password'])){
            $this->directivoRepository->actualizarDatoCargo('password', $data['password'], $data['correo']);
        }

        return [
            'mensaje' => 'Integrante de la directiva, actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();   
        $this->directivoRepository->actualizarEstadoDirectivo($data, $id_iglesia);

        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->directivoRepository->eliminarDirectivo($data['id'], $id_iglesia);
        $this->directivoRepository->eliminarUsuarios($data['correo']);

        return [
            'mensaje' => 'Integrante de la directiva, eliminado  correctamente.' 
        ];
    }

    public function validarCargaDirectivaExistente( int $id_cargo, int $id_directiva,int $id_iglesia)
    {
        if($this->directivoRepository->existeDirectivoCargo( $id_cargo, $id_directiva,$id_iglesia)){
            return [
                'excepcion' => true,
                'mensaje' => "El cargo seleccionado ya existe en esta directiva.",
                'status' => 400,
            ]; 
        }
    }
        
    public function validarUsuarioExistente(string $correo,$existe )
    {
        $respuesta = $this->directivaMiembroRepository->existeUsuario($correo);

            if($existe && !$respuesta){
                return [
                    'excepcion' => true,
                    'mensaje' => "El usuario '{$correo}' no existe.",
                    'status' => 400,
                ]; 
            }

            if(!$existe && $respuesta){
                return [
                    'excepcion' => true,
                    'mensaje' => "El usuario '{$correo}' ya se encuentra registrado.",
                    'status' => 400,
                ]; 
            }
    }
}
