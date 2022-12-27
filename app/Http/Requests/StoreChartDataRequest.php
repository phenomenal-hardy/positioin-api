<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreChartDataRequest extends FormRequest
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
        return [
            'userId' => 'required',            
            'chartAmount' => 'required',
            'chartDate' => 'required'
        ];
    }

    public function messages()
    {
        return [            
            'chartAmount.required' => "Ingresa un Monto.",
            'chartDate.required' => "Selecciona una fecha del Calendario."
        ];
    }
}
