<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE': {
                    return [];
                }
            case 'POST': {
                    return [
                        'name' => 'required|unique:users|min:3|max:20',
                        'email' => 'required|email|unique:users',
                        'roles' => 'required',
                        'password' => 'required|min:8'
                    ];
                }
            case 'PUT':
            case 'PATCH': {
                    return [
                        'name' => 'required|unique:users,id,' . $this->get('id') . '|min:3|max:20',
                        'email' => 'required|email|unique:users,id,' . $this->get('id'),
                        'roles' => 'required',
                        'password' => 'nullable|min:8'
                    ];
                }
            default:
                break;
        }
    }

    public function attributes()
    {
        return [
            'name'    => 'Nombre',
            'email'    => 'Correo electrónico',
            'roles' => 'Rol',
            'password' => 'Contraseña'
        ];
    }

    public function messages()
    {
        return [
            'email' => [
                'required' => 'Correo electrónico no es válido'
            ]
        ];
    }
}
