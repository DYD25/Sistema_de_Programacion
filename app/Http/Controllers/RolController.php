<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\RolService;
use App\Http\Requests\RolRequest;

class RolController extends Controller
{
    public function __construct(
        protected RolService $rolService,
    ) {}

    public function data()
    {
        try {
            return response()->json(
                $this->rolService->obtenerDatos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function store(RolRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->rolService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear el rol.'], 500);
        }
    }

    public function actualizar(rolRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->rolService->procesarParaActualizar($data);
            return response()->json($response);

        } catch (Throwable $t) {    
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos del rol.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->rolService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->rolService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar el rol.'], 500);
        }
    }
}

//             dd([
//     'error' => $t->getMessage(),
//     'line' => $t->getLine(),
//     'file' => $t->getFile(),
// ]);
