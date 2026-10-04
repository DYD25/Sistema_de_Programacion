<?php

namespace App\Http\Controllers;
use Throwable;

use Illuminate\Http\Request;
use App\Services\AreaService;
use App\Http\Requests\AreaRequest;

class AreaController extends Controller
{
    public function __construct(
        protected AreaService $areaService,
    ) {}

    public function index()
    {
        return view('area.index');
    }
     
    public function data()
    {
        try {
            return response()->json(
                $this->areaService->obtenerDatos()
            );
        } catch (Throwable $t) {
            
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }
     
    public function store(AreaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->areaService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {    
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear el area.'], 500);
        }
    }

    public function actualizar(AreaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->areaService->procesarParaActualizar($data);       
            return response()->json($response);

        } catch (Throwable $t) {    
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos de el area.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->areaService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado del area.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->areaService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar el area.'], 500);    
        }
    }

    public function consultar(Request $request)
    {
        try {
            $response = $this->areaService->procesarParaConsultar();
            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo consultar las areas.'], 500);    
        }
    }
    
    public function asignar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->areaService->procesarParaAsignar($data);
            return response()->json($response);
        } catch (Throwable $t) {
              dd([
            'error' => $t->getMessage(),
            'line' => $t->getLine(),
            'file' => $t->getFile(),
        ]);
            return response()->json(['error' => true, 'mensaje' => 'No se pudo asignar las areas.'], 500);    
        }
    }
  
}

