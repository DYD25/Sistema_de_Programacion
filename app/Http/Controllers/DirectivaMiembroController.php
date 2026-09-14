<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\DirectivaMiembroService;
use App\Http\Requests\DirectivaMiembroRequest;

class DirectivaMiembroController extends Controller
{
    public function __construct(
        protected DirectivaMiembroService $directivaMiembroService,
    ) {}


    public function index()
    {
        return view('directiva.index');
    }

    public function data()
    {
        try {
            return response()->json(
                $this->directivaMiembroService->obtenerDatos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function obtenerDirectivas()
    {
        try {
            return response()->json(
                $this->directivaMiembroService->obtenerDirectivas()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener las directivas.' ], 500);
        }
    }

    public function obtenerCargos()
    {
        try {
            return response()->json(
                $this->directivaMiembroService->obtenerCargos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener los cargos.' ], 500);
        }
    }

    public function store(DirectivaMiembroRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaMiembroService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear el miembro de la directiva.'], 500);
        }
    }

    public function actualizar(DirectivaMiembroRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaMiembroService->procesarParaActualizar($data);
            return response()->json($response);

        } catch (Throwable $t) {    
           
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaMiembroService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaMiembroService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { dd([
                'error' => $t->getMessage(),
                'line' => $t->getLine(),
                'file' => $t->getFile(),
            ]);
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar la persona.'], 500);
        }
    }




}
