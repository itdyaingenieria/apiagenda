<?php

namespace App\Http\Requests;

class ClientRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        switch ($this->method()) {
            case 'GET':
            case 'DELETE':
                return [];
            case 'POST':
                return [
                    'nombre' => 'required|max:255',
                    'cedula' => 'required|unique:App\Models\Client,cedula|max:20',
                    'fecha_nacimiento' => 'required|date_format:Y-m-d',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'nombre' => 'required|max:255',
                    'cedula' => 'required|unique:App\Models\Client,cedula,' . $this->client . ',id',
                    'fecha_nacimiento' => 'required|date_format:Y-m-d',
                ];
            default:
                break;
        }
    }

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
     * @return array
     * Custom validation message
     */
    public function messages()
    {
        return [
            'nombre.required' => 'El nombre Cliente es requerido!',
            'nombre.max' => 'El nombre del Cliente es de 255 caracteres!',
            'cedula.unique' => 'Esta Cédula ya está en sistema!',
            'cedula.max' => 'La cedula es de 20 caracteres!',
            'fecha_nacimiento.required' => 'Fecha Nacimiento es requerido!',
            'fecha_nacimiento.date_format' => 'Fecha Nacimiento no tiene formato YYYY-mm-dd.',
        ];
    }
}
