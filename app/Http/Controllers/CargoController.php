<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\CargoService;
use App\Http\Requests\CargoRequest;

class CargoController extends Controller
{
    public function __construct(
        protected CargoService $cargoService,
    ) {}

    public function index()
    {
        return view('cargo.index');
    }
      public function data()
    {
        try {
            return response()->json(
                $this->cargoService->obtenerDatos()
            );
        } catch (Throwable $t) {

            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function store(CargoRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->cargoService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {   
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear el cargo.'], 500);
        }
    }

    public function actualizar(CargoRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->cargoService->procesarParaActualizar($data);       
            return response()->json($response);

        } catch (Throwable $t) {    
         dd([
            'error' => $t->getMessage(),
            'line' => $t->getLine(),
            'file' => $t->getFile(),
        ]); 
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos del cargo.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->cargoService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado del cargo.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->cargoService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar el cargo.'], 500);    
        }
    }

    public function obtenerCargos()
    {
        try {
            return response()->json(
                $this->cargoService->procesarParaObtenerCargos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener los cargos.' ], 500);
        }
    }
  
}

// dd([
//             'error' => $t->getMessage(),
//             'line' => $t->getLine(),
//             'file' => $t->getFile(),
//         ]);