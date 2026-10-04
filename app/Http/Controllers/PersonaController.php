<?php

namespace App\Http\Controllers;

use Throwable;

use Illuminate\Http\Request;
use App\Http\Requests\PersonaRequest;
use App\Services\PersonaService;
// use Monolog\Formatter\LineFormatter;

class PersonaController extends Controller
{
    public function __construct(
        protected PersonaService $personaService,
    ) {}

    public function index()
    {
        return view('persona.index');
    }

    public function data()
    {
        try {
            return response()->json(
                $this->personaService->obtenerDatos()
            );
        } catch (Throwable $t) {
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function store(PersonaRequest $request)  
    {
        try {
            $data = $request->all();
            $response = $this->personaService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear la persona.'], 500);
        }
    }

    public function actualizar(PersonaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->personaService->procesarParaActualizar($data);   
            return response()->json($response);

        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->personaService->procesarParaEstado($data);
            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado.'], 500);
        }
    }

    public function eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->personaService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) {
             dd(['error' => $t->getMessage(),
                'Linea'=>$t->getLine(),
                'Archivo'=>$t->getFile(),
            ]);
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar la persona.'], 500);
        }
    }
}

