<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserSaveRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'unique:users'],
            'phone' => ['required', 'phone:UA', 'unique:user_additionallies'],
            'password' => ['required', 'string', 'min:6', 'max:32', 'confirmed'],
            'position_id' => ['required', 'numeric', 'exists:user_positions,id'],
            'photo' => ['required', 'image', 'max:5120', 'dimensions:min_width=70,min_height=70'],
        ];
    }
}
