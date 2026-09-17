<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\DirectivoService;   
use App\Http\Requests\DirectivoRequest;

class DirectivoController extends Controller
{
    public function __construct(
        protected DirectivoService $directivoService,
    ) {}

    public function index()
    {
        return view('directivo.index');
    }

    public function data()
    {
        try {
            return response()->json(
                $this->directivoService->obtenerDatos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function obtenerDirectivas()
    {
        try {
            return response()->json(
                $this->directivoService->obtenerDirectivas()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener las directivas.' ], 500);
        }
    }

    public function obtenerCargos()
    {
        try {
            return response()->json(
                $this->directivoService->obtenerCargos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener los cargos.' ], 500);
        }
    }

    public function store(DirectivoRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivoService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear el miembro de la directiva.'], 500);
        }
    }

    public function actualizar(DirectivoRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivoService->procesarParaActualizar($data);
            return response()->json($response);

        } catch (Throwable $t) {    
           
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivoService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivoService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar el directivo.'], 500);
        }
    }
}
// dd([
//     'error' => $t->getMessage(),
//     'line' => $t->getLine(),
//     'file' => $t->getFile(),
// ]);