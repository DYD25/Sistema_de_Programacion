<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;



class DirectivoRequest extends FormRequest
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
            'correo' => [
                'required',
                'max:50',
                'email',
                'exists:users,email',
                Rule::unique('directivas', 'correo')->ignore($this->id),
            ],
            'password' => 'sometimes|nullable|min:10',
            'id_cargo' => [
                'required',
                'exists:directivas,cargos_id',
            ],
            'id_persona' => [
                'required',
                'exists:personas,id',
                Rule::unique('persona_areas', 'id_persona')->ignore($this->id),
            ],

        ];
    }

    public function messages(): array
    {
        return [
      
            'correo.required' => 'El correo electrónico es obligatorio.',
            'correo.max' => 'El correo electrónico no puede exceder 50 caracteres.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener al menos 10 caracteres.',
            'id_cargo.required' => 'El cargo es obligatorio.',
            'id_persona.required' => 'La persona es obligatoria.',
            'id_persona.exists' => 'La persona no existe.',
            'id_persona.unique' => 'La persona ya está asignada a otra directiva.',

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
