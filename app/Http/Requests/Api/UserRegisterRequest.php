<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:2', 'max:60'],
            'email' => ['required', 'email'],
            'phone' => ['required', 'phone:UA'],
            'position_id' => ['required', 'numeric', 'exists:user_positions,id'],
            'photo' => ['image', 'max:5120', 'dimensions:min_width=70,min_height=70'],
            'password' => ['required', 'string', 'min:6', 'max:32'],
        ];
    }
}

