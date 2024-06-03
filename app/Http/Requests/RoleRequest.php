<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'name' => 'required|unique:roles|min:3|max:20',
                ];
            }
            case 'PUT':
            case 'PATCH':
            {
                return [
                    'name' => '|min:3|max:20|unique:roles,id,'.$this->get('id'),
                ];
            }
            default:break;
        }
    }
    public function attributes()
    {
        return [
            'name'    => 'Nombre'
        ];
    }
}
