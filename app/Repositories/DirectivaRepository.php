<?php

namespace App\Repositories;

use App\Models\Directiva;
use App\Models\Cargo;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DirectivaRepository
{
    public function listarDirectivas(string $id_iglesia)
    {
        return Directiva::with([
            'usuario:id,name,email',
            'cargo:id,nombre',
            'directiva:id,nombre',
        ])->select('id', 'usuario_id', 'cargo_id', 'id_persona','estado', 'created_at')
            ->where('iglesia_id', $id_iglesia)
            ->get();
    }


    // public function listarDirectivos()
    // {
    //     return Directivo::where('estado', 1)
    //         ->orderBy('id')
    //         ->get();
    // }

    public function listarCargos()
    {
        return Cargo::where('estado', 1)
            ->orderBy('nombre')
            ->get();
    }

    // public function registrarUsuario(array $datos): int
    // {
    //      $user = User::create([
    //         'name' => $datos['nombre'],
    //         'email' => $datos['correo'],
    //         'password' => Hash::make($datos['password']),
    //     ]);
    //     return $user->id;
    // }

    // public function guardarDirectivo(array $datos, int $id_iglesia,int $id_usuario): void
    // {
    //     Directivo::create([
    //         'usuario_id' => $id_usuario,
    //         'cargo_id' => $datos['id_cargo'],
    //         'directiva_id' => $datos['id_directiva'],
    //         'estado' => 1,
    //         'iglesia_id' => $id_iglesia
    //     ]);
    // }

    // public function actualizarDirectivo(array $datos, int $id_iglesia): void
    // {
    //     Directivo::where('id', $datos['id'])->where('iglesia_id', $id_iglesia)
    //         ->update([
    //             'cargo_id' => $datos['id_cargo'],
    //             'directiva_id' => $datos['id_directiva'],
    //         ]);
    // }

    // public function actualizarDatoCargo(string $campo, string $valor, string $correo): void
    // {
    //     User::where('email', $correo)->update([$campo => $valor,]);
    // }
    
    // public function actualizarEstadoDirectivo(array $datos, int $id_iglesia): void
    // {
    //     Directivo::where('id', $datos['id'])->where('iglesia_id', $id_iglesia)
    //         ->update([
    //             'estado' => !$datos['estado'],
    //         ]);
    // }
    
    // public function eliminarDirectivo(int $id, int $id_iglesia): void
    // {
    //     DirectivaMiembro::where('id', $id)->where('iglesia_id', $id_iglesia)   
    //         ->delete();
    // }

    // public function eliminarUsuarios(string $correo): void
    // {
    //     User::where('email', $correo)->delete();
    // }

    // public function existeDirectivaCargo(int $id_cargo, int $id_directiva,int $id_iglesia): bool
    // {
    //     return DirectivaMiembro::where('iglesia_id', $id_iglesia)
    //         ->where('cargo_id', $id_cargo)
    //         ->where('directiva_id', $id_directiva)
    //         ->exists();
    // }

    // public function existeUsuario(string $correo)
    // {
    //     return User::where('email', $correo)->exists();
    // }
    


}
