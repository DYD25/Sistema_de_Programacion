<?php

namespace App\Services;

use Exception;
use App\Repositories\DirectivaMiembroRepository;
use App\Services\ContextoService;

class DirectivaMiembroService
{

    public function __construct(
        protected DirectivaMiembroRepository $directivaMiembroRepository, protected ContextoService $contextoService)
    { }

    public function obtenerDatos(): array
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        if (!$id_iglesia) {
            return [];
        }
     
        $directivas = $this->directivaMiembroRepository->listar($id_iglesia);

        return [
            'data' => $directivas
        ];
    }

    public function obtenerDirectivas(): array
    {
        $directivas = $this->directivaMiembroRepository->listarDirectivas();

        return [
            'data' => $directivas
        ];
    }

    public function obtenerCargos(): array
    {
        $cargos = $this->directivaMiembroRepository->listarCargos();

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
        
        $id_usuario = $this->directivaMiembroRepository->registrarUsuario($data);
        $this->directivaMiembroRepository->guardarDirectivaMiembro($data, $id_iglesia,$id_usuario);

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
        
        $this->directivaMiembroRepository->actualizarDirectivaMiembro($data, $id_iglesia);
        $this->directivaMiembroRepository->actualizarDatoUsuario('name', $data['nombre'], $data['correo']);

        if(!empty($data['password'])){
            $this->directivaMiembroRepository->actualizarDatoUsuario('password', $data['password'], $data['correo']);
        }

        return [
            'mensaje' => 'Integrante de la directiva, actualizado correctamente.'
        ];
    }

    public function procesarParaEstado(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();   
        $this->directivaMiembroRepository->actualizarEstadoDirectivaMiembros($data, $id_iglesia);

        return [
            'mensaje' => 'Estado actualizado correctamente.'    
        ];
    }

    public function procesarParaEliminar(array $data)
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        $this->directivaMiembroRepository->eliminarDirectivaMiembros($data['id'], $id_iglesia);
        $this->directivaMiembroRepository->eliminarUsuarios($data['correo']);

        return [
            'mensaje' => 'Integrante de la directiva, eliminado  correctamente.' 
        ];
    }

    public function validarCargaDirectivaExistente( int $id_cargo, int $id_directiva,int $id_iglesia)
    {
        if($this->directivaMiembroRepository->existeDirectivaCargo( $id_cargo, $id_directiva,$id_iglesia)){
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
