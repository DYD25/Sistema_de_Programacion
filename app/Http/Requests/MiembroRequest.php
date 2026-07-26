<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;

class MiembroRequest extends FormRequest
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
                'string',
                'max:20',
                'regex:/^[\pL\s]+$/u',
            ],
            'nombre_whatsapp' => 'required|max:50',
            'telefono' => 'required|digits:10',

        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.regex' => 'El nombre solo puede contener letras y espacios.',
            'nombre.max' => 'El nombre no puede exceder 20 caracteres.',
            'nombre_whatsapp.required' => 'El nombre de Whatsapp es obligatorio.',
            'nombre_whatsapp.max' => 'El nombre de Whatsapp no puede exceder 50 caracteres.',
            'telefono.required' => 'El número de teléfono es obligatorio.',
            'telefono.digits' => 'El número de teléfono debe tener exactamente 10 dígitos.',
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
