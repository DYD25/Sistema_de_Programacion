<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RolRequest extends FormRequest
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
            'nombre-rol' => [
                'required',
                Rule::unique('rols', 'nombre')->ignore($this->id),
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:20',
            ],
            'descripcion-rol' => 'required|max:100',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre-rol.required' => 'El nombre es obligatorio.',
            'nombre-rol.unique' => 'El rol ya se encuentra registrado.',
            'nombre-rol.regex' => 'El rol solo puede contener letras, números y espacios.',
            'nombre-rol.max' => 'El rol no puede exceder 20 caracteres.',
            'descripcion-rol.required' => 'La descripción es obligatoria.',
            'descripcion-rol.max' => 'La descripción no puede exceder 100 caracteres.',
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
