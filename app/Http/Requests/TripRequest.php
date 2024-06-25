<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
            'food_id' => 'required',
            'p_type_id' => 'required',
            'bus_name' => 'required',
            'departure' => 'required',
            'destination' => 'required',
            'departure_date' => 'required|date',
            'number_of_seats' => 'required|integer',
            'fare' => 'required|integer',   
        ];
    }
}