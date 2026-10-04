<?php

namespace App\Http\Requests;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AreaRequest extends FormRequest
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
                  Rule::unique('areas', 'nombre')
                    ->where(fn ($query) => $query->where('iglesia_id', $this->iglesia_id))
                    ->ignore($this->id),
                'regex:/^[a-zA-Z0-9\s]+$/',
                'max:20',
            ],
            'descripcion' => 'required|max:100',
        ];
    }

    public function messages(): array
    {
         return [
            'nombre.required' => 'El nombre del Area/Ministerio es obligatorio.',
            'nombre.unique' => 'El Area/Ministerio ya se encuentra registrado.',
            'iglesia_id.unique' => 'El Area/Ministerio ya se encuentra registrado en esta iglesia.',
            'nombre.regex' => 'El Area/Ministerio solo puede contener letras, números y espacios.',
            'nombre.max' => 'El Area/Ministerio no puede exceder 20 caracteres.',
            'descripcion.required' => 'La descripción del Area/Ministerio es obligatoria.',
            'descripcion.max' => 'La descripción del Area/Ministerio no puede exceder 100 caracteres.',
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
