<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\PermisoService;
use App\Http\Requests\PermisoRequest;

class PermisoController extends Controller
{
    public function __construct(
        protected PermisoService $permisoService,
    ) {}


    public function data()
    {
        try {
            return response()->json(
                $this->permisoService->obtenerDatos()
            );
        } catch (Throwable $t) {
            return response()->json(['error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function consultar(Request $request)
    {
        try {
            return response()->json(
                $this->permisoService->consultarPermisos()
            );
        } catch (Throwable $t) {
            return response()->json(['error' => true,'mensaje' => 'No fue posible obtener los permisos.' ], 500);
        }
    }


    public function store(PermisoRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->permisoService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear el permiso.'], 500);
        }
    }

    public function actualizar(PermisoRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->permisoService->procesarParaActualizar($data);
            return response()->json($response);

        } catch (Throwable $t) {   
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->permisoService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado del permiso.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->permisoService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar el permiso.'], 500);
        }
    }
}

//             dd([
//     'error' => $t->getMessage(),
//     'line' => $t->getLine(),
//     'file' => $t->getFile(),
// ]); 