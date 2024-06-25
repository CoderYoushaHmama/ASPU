<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class ProfileRequest extends FormRequest
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
            'username' => 'required|unique:users,username,'.Auth::guard('user')->user()->id,
            'email' => 'required|email|unique:users,email,'.Auth::guard('user')->user()->id,
            'phone_number' => 'required|unique:users,phone_number,'.Auth::guard('user')->user()->id,
            'address' => 'required',
        ];
    }
}