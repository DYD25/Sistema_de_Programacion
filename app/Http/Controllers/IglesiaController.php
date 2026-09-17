<?php

namespace App\Http\Controllers;
use Throwable;
use App\Http\Requests\iglesiaRequest;
use App\Services\IglesiaService;
use Illuminate\Http\Request;

class IglesiaController extends Controller
{
    public function __construct(
        protected IglesiaService $iglesiaService
    ) {}

    public function seleccionar(Request $request)
    {
        $request->validate([
            'iglesia_id' => 'required|string|exists:iglesias,id',  
        ]);

        return response()->json(
            $this->iglesiaService->seleccionar($request->iglesia_id)
        );
    }

    public function index()
    {
        return view('iglesia.index');
    }

      public function data()
    {
        try {
            return response()->json(
                $this->iglesiaService->obtenerDatos()
            );
        } catch (Throwable $t) {
   
            return response()->json([  'error' => true,'mensaje' => 'No fue posible obtener la información.' ], 500);
        }
    }

    public function store(iglesiaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->iglesiaService->procesarParaGuardar($data);
            return response()->json($response);

        } catch (Throwable $t) {    
            return response()->json(['error' => true, 'mensaje' => 'No se pudo crear la iglesia.'], 500);
        }
    }

    public function actualizar(iglesiaRequest $request)
    {
        try {
            $data = $request->all();
            $response = $this->iglesiaService->procesarParaActualizar($data);       
            return response()->json($response);

        } catch (Throwable $t) {    
            return response()->json(['error' => true, 'mensaje' => 'No se pudieron actualizar los datos de la iglesia.'], 500);
        }
    }

    public function estado(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->iglesiaService->procesarParaEstado($data);

            return response()->json($response);
        } catch (Throwable $t) {
            return response()->json(['error' => true, 'mensaje' => 'No se pudo actualizar el estado de la iglesia.'], 500);
        }
    }

    public function  eliminar(Request $request)
    {
        try {
            $data = $request->all();
            $response = $this->iglesiaService->procesarParaEliminar($data);
            return response()->json($response);
        } catch (Throwable $t) { 
            return response()->json(['error' => true, 'mensaje' => 'No se pudo eliminar la iglesia.'], 500);    
        }
    }
}
//          dd([
//     'error' => $t->getMessage(),
//     'line' => $t->getLine(),
//     'file' => $t->getFile(),
// ]);