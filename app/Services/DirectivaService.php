<?php

namespace App\Services;

use App\Repositories\DirectivaRepository;
use App\Services\ContextoService;

class DirectivaService
{

    public function __construct(
        protected DirectivaRepository $directivaRepository, protected ContextoService $contextoService)
    { }

    public function obtenerDatos(): array
    {
        $id_iglesia = $this->contextoService->obtenerIglesiaId();
        if (!$id_iglesia) {
            return [];
        }
     
        $directivas = $this->directivaRepository->listarDirectivas($id_iglesia);

        return [
            'data' => $directivas
        ];
    }

    // public function obtenerDirectivas(): array
    // {
    //     $directivas = $this->directivaRepository->listarDirectivas();

    //     return [
    //         'data' => $directivas
    //     ];
    // }

 

    // public function procesarParaGuardar(array $data)
    // {
    //     $id_iglesia = $this->contextoService->obtenerIglesiaId();
    //     $respusta_directiva =  $this->validarCargaDirectivaExistente($data['id_cargo'], $data['id_directiva'], $id_iglesia);
    //     if($respusta_directiva) return $respusta_directiva;

    //     $respusta_usuario =  $this->validarUsuarioExistente($data['correo'], false);
    //     if($respusta_usuario) return $respusta_usuario;
        
    //     $id_usuario = $this->directivaRepository->registrarUsuario($data);
    //     $this->directivaRepository->guardarDirectivo($data, $id_iglesia,$id_usuario);

    //     return [
    //         'mensaje' => 'Integrante de la directiva, registrado correctamente.'
    //     ];
    // }

    // public function procesarParaActualizar(array $data)
    // {
    //     $id_iglesia = $this->contextoService->obtenerIglesiaId();
    //     $respusta_directiva =  $this->validarCargaDirectivaExistente($data['id_cargo'], $data['id_directiva'], $id_iglesia);
    //     if($respusta_directiva) return $respusta_directiva;

    //     $respusta_usuario =  $this->validarUsuarioExistente($data['correo'], true);
    //     if($respusta_usuario) return $respusta_usuario;
        
    //     $this->directivaRepository->actualizarDirectivo($data, $id_iglesia);
    //     $this->directivaRepository->actualizarDatoCargo('name', $data['nombre'], $data['correo']);

    //     if(!empty($data['password'])){
    //         $this->directivaRepository->actualizarDatoCargo('password', $data['password'], $data['correo']);
    //     }

    //     return [
    //         'mensaje' => 'Integrante de la directiva, actualizado correctamente.'
    //     ];
    // }

    // public function procesarParaEstado(array $data)
    // {
    //     $id_iglesia = $this->contextoService->obtenerIglesiaId();   
    //     $this->directivaRepository->actualizarEstadoDirectivo($data, $id_iglesia);

    //     return [
    //         'mensaje' => 'Estado actualizado correctamente.'    
    //     ];
    // }

    // public function procesarParaEliminar(array $data)
    // {
    //     $id_iglesia = $this->contextoService->obtenerIglesiaId();
    //     $this->directivaRepository->eliminarDirectivo($data['id'], $id_iglesia);
    //     $this->directivaRepository->eliminarUsuarios($data['correo']);

    //     return [
    //         'mensaje' => 'Integrante de la directiva, eliminado  correctamente.' 
    //     ];
    // }

    // public function validarCargaDirectivaExistente( int $id_cargo, int $id_directiva,int $id_iglesia)
    // {
    //     if($this->directivaRepository->existeDirectivoCargo( $id_cargo, $id_directiva,$id_iglesia)){
    //         return [
    //             'excepcion' => true,
    //             'mensaje' => "El cargo seleccionado ya existe en esta directiva.",
    //             'status' => 400,
    //         ]; 
    //     }
    // }
        
    // public function validarUsuarioExistente(string $correo,$existe )
    // {
    //     $respuesta = $this->directivaMiembroRepository->existeUsuario($correo);

    //         if($existe && !$respuesta){
    //             return [
    //                 'excepcion' => true,
    //                 'mensaje' => "El usuario '{$correo}' no existe.",
    //                 'status' => 400,
    //             ]; 
    //         }

    //         if(!$existe && $respuesta){
    //             return [
    //                 'excepcion' => true,
    //                 'mensaje' => "El usuario '{$correo}' ya se encuentra registrado.",
    //                 'status' => 400,
    //             ]; 
    //         }
    // }
}
