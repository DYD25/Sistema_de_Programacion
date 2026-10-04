<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PermisoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nombre-permiso' => [
                'required',
                Rule::unique('permisos', 'nombre')->ignore($this->id),
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:20',
            ],
            'descripcion-permiso' => 'required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre-permiso.required' => 'El nombre es obligatorio.',
            'nombre-permiso.unique' => 'El permiso ya se encuentra registrado.',
            'nombre-permiso.regex' => 'El permiso solo puede contener letras, números y espacios.',
            'nombre-permiso.max' => 'El permiso no puede exceder 20 caracteres.',
            'descripcion-permiso.required' => 'La descripción es obligatoria.',
            'descripcion-permiso.max' => 'La descripción no puede exceder 100 caracteres.', 
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'validacion' => true,
            'mensaje' => 'Errores de validación',
            'errores' => $validator->errors()
        ], 422));
    }
}
