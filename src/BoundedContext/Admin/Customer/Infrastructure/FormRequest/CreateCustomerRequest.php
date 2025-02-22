<?php

namespace Core\BoundedContext\Admin\Customer\Infrastructure\FormRequest;

use Core\Shared\Infrastructure\FormRequest\AppBaseFormRequest;

class CreateCustomerRequest extends AppBaseFormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Defines the validation rules to be applied to the request.
     *
     * @return array An array containing the validation rules for the request fields.
     */
    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'unique:customers',
                'string',
                'max:255',
            ],
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
            'name.required' => 'El nombre del cliente es obligatorio.',
            'name.unique' => 'El cliente ya existe en la base de datos.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.max' => 'El campo nombre no debe exceder los 255 caracteres.',
        ];
    }
}
