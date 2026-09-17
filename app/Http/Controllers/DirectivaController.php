<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\DirectivaService;
use App\Http\Requests\DirectivaRequest;

class DirectivaController extends Controller
{
    public function __construct(
        protected DirectivaService $directivaService,
    ) {}

    public function index()
    {
        return view('directiva.index');
    }
     
    public function data()
    {
        try {
            return response()->json(
                $this->directivaService->obtenerDatos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }
     
    public function store(DirectivaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {    
  
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear la directiva.'], 500);
        }
    }

    public function actualizar(DirectivaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaService->procesarParaActualizar($data);       
            return response()->json($response);

        } catch (Throwable $t) {    
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos de la directiva.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado del cargo.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->directivaService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar la directiva.'], 500);    
        }
    }
  
}

// dd([
//             'error' => $t->getMessage(),
//             'line' => $t->getLine(),
//             'file' => $t->getFile(),
//         ]);