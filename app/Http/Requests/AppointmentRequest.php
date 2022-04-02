<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;

class AppointmentRequest extends FormRequest
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
                    'asunto' => 'required|max:255',
                    'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
                    'client_id' => 'required',
                    'state_id' => 'required',
                ];
            case 'PUT':
            case 'PATCH':
                return [
                    'asunto' => 'required|max:255',
                    'fecha_hora' => 'required|date_format:Y-m-d H:i:s',
                    'client_id' => 'required',
                    // 'state_id' => Rule::where(function ($query) {
                    //     return $query->where('state_id', '=', 1);
                    // }),
                    'state_id' => 'required',
                    //'state_id' => 'prohibitedIf(' . $this->state_id . ', <>, 1)',
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
            'asunto.required' => 'El Asunto de la Cita requerido!',
            'asunto.max' => 'El Asunto de la cita, es de 255 caracteres!',
            'fecha_hora.required' => 'Fecha y Hora de Cita es requerido!',
            'fecha_hora.date_format' => 'Fecha y Hora de Cita No tiene el formato Esperado!',
            'state_id.required' => 'El estado de la Cita es Requerido!!',
            'client_id.required' => 'El Cliente de la cita es requerido!',
            'state_id.prohibitedIf' => 'El estado ya no es Programada, Cita Cumplida!',
        ];
    }
}
