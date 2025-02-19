<?php

namespace Core\BoundedContext\Tenant\Auth\Infrastructure\FormRequest;

use Core\Shared\Infrastructure\FormRequest\AppBaseFormRequest;

class AuthRequest extends AppBaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Defines the validation rules for the authentication request.
     *
     * @return array An array containing the validation rules for the request fields.
     */
    public function rules(): array
    {
        return [
            'email' => 'required|email',
            'password' => 'required'
        ];
    }

    /**
     * Define custom validation messages for the specified rules.
     *
     * @return array An array that maps rules to custom messages.
     */
    public function messages(): array
    {
        return [
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.email' => 'Ingrese un correo electrónico válido.',
            'password.required' => 'La contraseña es requerida.',
        ];
    }
}
