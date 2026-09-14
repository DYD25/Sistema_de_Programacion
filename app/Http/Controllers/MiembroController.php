<?php

namespace App\Http\Controllers;

use Throwable;
use Exception;

use Illuminate\Http\Request;
use App\Http\Requests\MiembroRequest;
use App\Services\MiembroService;
// use Monolog\Formatter\LineFormatter;

class MiembroController extends Controller
{
    public function __construct(
        protected MiembroService $miembroService,
    ) {}

    public function index()
    {
        return view('miembro.index');
    }

    public function data()
    {
        try {
            return response()->json(
                $this->miembroService->obtenerDatos()
            );
        } catch (Throwable $e) {

            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function store(MiembroRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->miembroService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear la persona.'], 500);
        }
    }

    public function actualizar(MiembroRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->miembroService->procesarParaActualizar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->miembroService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->miembroService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar la persona.'], 500);
        }
    }
}
//  dd(['error' => $t->getMessage(),
//                 'Linea'=>$t->getLine(),
//                 'Archivo'=>$t->getFile(),
//             ]);