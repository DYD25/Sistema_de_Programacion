<?php

namespace App\Http\Controllers;
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
            'iglesia_id' => 'required|integer|exists:iglesias,id',
        ]);

        return response()->json(
            $this->iglesiaService->seleccionar($request->iglesia_id)
        );
    }
}
