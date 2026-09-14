<?php

namespace App\Repositories;

use App\Models\DirectivaMiembro;
use App\Models\Directiva;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DirectivaMiembroRepository
{


    public function listar(int $id_iglesia)
    {
        return DirectivaMiembro::with([
            'usuario:id,name,email',
            'cargo:id,nombre',
            'directiva:id,nombre',
        ])->select('id', 'usuario_id', 'cargo_id', 'directiva_id','estado')
            ->where('iglesia_id', $id_iglesia)
            ->get();
    }


    public function listarDirectivas()
    {
        return Directiva::where('estado', 1)
            ->orderBy('nombre')
            ->get();
    }

    public function listarCargos()
    {
        return Cargo::where('estado', 1)
            ->orderBy('nombre')
            ->get();
    }

    public function registrarUsuario(array $datos): int
    {
         $user = User::create([
            'name' => $datos['nombre'],
            'email' => $datos['correo'],
            'password' => Hash::make($datos['password']),
        ]);
        return $user->id;
    }

    public function guardarDirectivaMiembro(array $datos, int $id_iglesia,int $id_usuario): void
    {
        DirectivaMiembro::create([
            'usuario_id' => $id_usuario,
            'cargo_id' => $datos['id_cargo'],
            'directiva_id' => $datos['id_directiva'],
            'estado' => 1,
            'iglesia_id' => $id_iglesia
        ]);
    }

    public function actualizarDirectivaMiembro(array $datos, int $id_iglesia): void
    {
        DirectivaMiembro::where('id', $datos['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'cargo_id' => $datos['id_cargo'],
                'directiva_id' => $datos['id_directiva'],
            ]);
    }

    public function actualizarDatoUsuario(string $campo, string $valor, string $correo): void
    {
        User::where('email', $correo)->update([$campo => $valor,]);
    }
    
    public function actualizarEstadoDirectivaMiembros(array $datos, int $id_iglesia): void
    {
        DirectivaMiembro::where('id', $datos['id'])->where('iglesia_id', $id_iglesia)
            ->update([
                'estado' => !$datos['estado'],
            ]);
    }
    
    public function eliminarDirectivaMiembros(int $id, int $id_iglesia): void
    {
        DirectivaMiembro::where('id', $id)->where('iglesia_id', $id_iglesia)   
            ->delete();
    }

    public function eliminarUsuarios(string $correo): void
    {
        User::where('email', $correo)->delete();
    }

    public function existeDirectivaCargo(int $id_cargo, int $id_directiva,int $id_iglesia): bool
    {
        return DirectivaMiembro::where('iglesia_id', $id_iglesia)
            ->where('cargo_id', $id_cargo)
            ->where('directiva_id', $id_directiva)
            ->exists();
    }

    public function existeUsuario(string $correo)
    {
        return User::where('email', $correo)->exists();
    }
    


}
