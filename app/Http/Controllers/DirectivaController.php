<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DirectivaController extends Controller
{
    public function index()
    {
        $directivas = [
            (object) ['nombre' => 'Juan Pérez', 'cargo' => 'Pastor'],
            (object) ['nombre' => 'María Gómez', 'cargo' => 'Tesorera'],
        ];
    
        return view('directiva.index', compact('directivas'));
        // return view('directiva.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
}
