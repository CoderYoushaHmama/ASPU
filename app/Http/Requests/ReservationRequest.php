<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'trip_id' => 'required',
            'reservation_date' => 'required|date',
            'passenger_email' => 'required|email',
            'passenger_phone_number' => 'required',
            'passenger_name' => 'required',
        ];
    }
}
