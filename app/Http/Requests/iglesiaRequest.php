<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class IglesiaRequest extends FormRequest
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
            'nombre' => [
                'required',
                Rule::unique('iglesias', 'nombre')->ignore($this->id),
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:20',
            ],
            'direccion' => [
                'required',
                Rule::unique('iglesias', 'direccion')->ignore($this->id),
                'string',
                'max:20',
            ],
            'ciudad' => 'required|max:20',
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.unique' => 'El nombre ya se encuentra registrado.',
            'nombre.regex' => 'El nombre solo puede contener letras, números y espacios.',
            'nombre.max' => 'El nombre no puede exceder 20 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.unique' => 'La dirección ya se encuentra registrado.',
            'direccion.string' => 'La dirección solo puede contener letras, números y espacios.',
            'direccion.max' => 'La dirección no puede exceder 20 caracteres.',
            'ciudad.required' => 'La ciudad es obligatoria.',
            'ciudad.string' => 'La ciudad solo puede contener letras, números y espacios.',
            'ciudad.max' => 'La ciudad no puede exceder 20 caracteres.',
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
